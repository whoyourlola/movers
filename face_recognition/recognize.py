import requests
import json
from deepface import DeepFace
import os
import time

# Configuration for the API URLs
get_url = "https://hr3.moverstaxi.com/movers/api/ai_login_ver.php"
update_url = "https://hr3.moverstaxi.com/movers/api/ai_login_ver_update.php"

# Headers for the requests (ensure valid PHPSESSID)
headers = {
    'Content-Type': 'application/json',
    'Cookie': 'PHPSESSID=4cvmslh979r81vb2kvniter2q6'
}

# Function to verify face using DeepFace
def verify_face(captured_image_path, reference_folder, expected_user_id):
    try:
        result = DeepFace.find(
            img_path=captured_image_path,
            db_path=reference_folder,
            enforce_detection=True,
            detector_backend='opencv'
        )

        df = result[0]
        if df.shape[0] > 0:
            best_match_path = df.iloc[0]['identity']
            rel_path = os.path.relpath(best_match_path, reference_folder)
            matched_user_folder = os.path.normpath(os.path.dirname(rel_path)).split(os.sep)[0]

            if matched_user_folder == expected_user_id:
                return True
        return False
    except Exception as e:
        print(f"ERROR in DeepFace: {str(e)}")
        return False

# Main loop that repeats every 30 seconds
while True:
    print("Checking for login images to verify...")

    # Step 1: Fetch records (login images)
    payload = json.dumps({
        "date_from": "2025-04-01",
        "date_to": "2025-04-24"
    })

    try:
        response = requests.get(get_url, headers=headers, data=payload, verify=False)

        if response.status_code == 200:
            data = response.json()

            # Step 2: Loop through each record and perform face verification
            for record in data['records']:
                login_image_path = record['login_image']
                time_logs_id = record['id']
                user_id = str(record['user_id'])

                captured_image_path = f"https://hr3.moverstaxi.com/movers/{login_image_path}"
                reference_folder = "reference_images"

                is_match = verify_face(captured_image_path, reference_folder, user_id)

                ai_ver = "match" if is_match else "fail"

                update_payload = json.dumps({
                    "ai_ver": ai_ver,
                    "time_logs_id": time_logs_id
                })

                update_response = requests.post(update_url, headers=headers, data=update_payload, verify=False)
                print(f"Updated verification for ID {time_logs_id} (user_id={user_id}): {update_response.text}")
        else:
            print("Failed to fetch records:", response.text)

    except Exception as e:
        print(f"ERROR during process: {e}")

    print("Waiting 30 seconds before next run...\n")
    time.sleep(30)
