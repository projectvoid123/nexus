import sys
import json
import requests
import os
from dotenv import load_dotenv

# Load environment variables from /var/www/.env
load_dotenv('/var/www/.env')

# Get API configuration from environment
API_KEY = os.getenv('DEEPINFRA_API_KEY')
API_URL = "https://api.deepinfra.com/v1/openai/chat/completions"

def generate_response(prompt, system_prompt=None, temperature=0.4, model="mistralai/Mixtral-8x7B-Instruct-v0.1"):
    try:
        # Add input validation
        if not prompt or len(prompt.strip()) == 0:
            return "Please provide a valid message."
            
        # Default system prompt if none provided
        default_prompt = """You are a helpful AI assistant."""
        
        headers = {
            'Authorization': f'Bearer {API_KEY}',
            'Content-Type': 'application/json',
            'X-RateLimit-Limit': '60',
            'X-RateLimit-Remaining': '59'
        }
        
        if not API_KEY:
            return "Error: API key not configured"

        data = {
            "model": model,
            "messages": [
                {
                    "role": "system",
                    "content": system_prompt if system_prompt else default_prompt
                },
                {
                    "role": "user",
                    "content": prompt
                }
            ],
            "temperature": float(temperature),
            "max_tokens": 2048
        }

        response = requests.post(
            API_URL,
            headers=headers,
            json=data,
            timeout=120
        )

        if response.status_code != 200:
            return f"API Error: {response.status_code}"

        result = response.json()
        
        if 'choices' in result and len(result['choices']) > 0:
            return result['choices'][0]['message']['content'].strip()
        
        return "Sorry, I could not generate a response."

    except Exception as e:
        return f"Error: {str(e)}"

if __name__ == "__main__":
    try:
        if len(sys.argv) < 2:
            print("Error: No message provided", file=sys.stderr)
            sys.exit(1)

        user_message = sys.argv[1]
        system_prompt = sys.argv[2] if len(sys.argv) > 2 and sys.argv[2] != "''" else None
        temperature = float(sys.argv[3]) if len(sys.argv) > 3 else 0.4
        model = sys.argv[4] if len(sys.argv) > 4 else "mistralai/Mixtral-8x7B-Instruct-v0.1"
        response = generate_response(user_message, system_prompt, temperature, model)
        print(response)
        
    except Exception as e:
        print(f"Error in main: {str(e)}", file=sys.stderr)
        sys.exit(1) 