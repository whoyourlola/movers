function updateTime() {
    const now = new Date();
    
    // Get the current time in the Philippines (UTC+8)
    const philippineTime = new Date(now.toLocaleString("en-US", { timeZone: "Asia/Manila" }));

    // Digital clock
    const hours = philippineTime.getHours().toString().padStart(2, '0');
    const minutes = philippineTime.getMinutes().toString().padStart(2, '0');
    const seconds = philippineTime.getSeconds().toString().padStart(2, '0');
    document.getElementById('digital-clock').textContent = `${hours}:${minutes}:${seconds}`;

    // Date display
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = philippineTime.toLocaleDateString('en-US', options);
    document.getElementById('date').textContent = date;

    
}

setInterval(updateTime, 1000); // Update the time every second
updateTime(); // Initial call to set the time right away
