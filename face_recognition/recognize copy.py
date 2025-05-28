from deepface import DeepFace
import os
import sys

# Get captured image path from command-line arguments (if available)
captured_image_path = sys.argv[1] if len(sys.argv) > 1 else "Capture2.png"
reference_folder = "reference_images"

try:
    # Perform face search across nested folders
    result = DeepFace.find(
        img_path=captured_image_path,
        db_path=reference_folder,
        enforce_detection=True,
        detector_backend='opencv'  # You can switch to 'retinaface', 'mtcnn', etc.
    )

    df = result[0]  # DeepFace.find returns a list of DataFrames
    if df.shape[0] > 0:
        best_match_path = df.iloc[0]['identity']

        # Get path relative to the reference folder
        rel_path = os.path.relpath(best_match_path, reference_folder)

        # Extract the folder path (user ID) from the relative path
        user_folder = os.path.dirname(rel_path)

        print(f"MATCH:{user_folder}")  # Output: MATCH:user_id or MATCH:user_id/subfolder if nested further
    else:
        print("NO_MATCH")

except Exception as e:
    print(f"ERROR:{str(e)}")
