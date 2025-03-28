import requests
import time

# URL of the PHP script
url = 'http://localhost:3000/Webserver/EN-en/drinks/coffee.php'

try:
    # Fetch data from the PHP script
    response = requests.get(url)
    if response.status_code == 200:
        # Parse JSON response
        data = response.json()
        gpio_pin = data['gpio_pin']
        time_duration = data['time_duration']
        print(f"GPIO Pin: {gpio_pin}, Time Duration: {time_duration} seconds")
    else:
        print(f"Failed to fetch data. Status code: {response.status_code}")
except requests.exceptions.RequestException as e:
    print(f"HTTP request failed: {e}")
except KeyError as e:
    print(f"Invalid JSON data: {e}")
except Exception as e:
    print(f"An unexpected error occurred: {e}")