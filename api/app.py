from flask import Flask, request, jsonify
from flask_cors import CORS
import pickle
import os
import pandas as pd
import logging
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.naive_bayes import MultinomialNB

# Initialize Flask app
app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

# Configure logging
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

# Ensure correct paths for the model and vectorizer
base_dir = os.path.dirname(__file__)
model_dir = os.path.join(base_dir, 'model')
model_path = os.path.join(model_dir, 'spam_classifier.pkl')
vectorizer_path = os.path.join(model_dir, 'vectorizer.pkl')

# Create the model directory if it doesn't exist
os.makedirs(model_dir, exist_ok=True)

# Load model and vectorizer
model = None
vectorizer = None

try:
    if os.path.exists(model_path) and os.path.exists(vectorizer_path):
        with open(model_path, 'rb') as model_file:
            model = pickle.load(model_file)
        with open(vectorizer_path, 'rb') as vectorizer_file:
            vectorizer = pickle.load(vectorizer_file)
        logging.info("Model and vectorizer loaded successfully.")
    else:
        raise FileNotFoundError("Model or vectorizer file not found.")
except Exception as e:
    logging.error(f"Error loading model and vectorizer: {e}")

# Example data
X_train = ["spam message", "ham message"]
y_train = [1, 0]

# Create and train the model
vectorizer = TfidfVectorizer()
X_train_tfidf = vectorizer.fit_transform(X_train)
model = MultinomialNB().fit(X_train_tfidf, y_train)

# Save the model and vectorizer
with open(model_path, 'wb') as model_file:
    pickle.dump(model, model_file)
with open(vectorizer_path, 'wb') as vectorizer_file:
    pickle.dump(vectorizer, vectorizer_file)

# Home route
@app.route('/')
def home():
    return 'Welcome to the SMS Classifier API. Use /fetch-data to get data or /predict for predictions.'

# Fetch CSV data route
@app.route('/fetch-data', methods=['GET'])
def fetch_data():
    try:
        # Set path to the CSV file
        csv_file_path = os.path.join(base_dir, 'Text-spam.csv')
        # Read and process the CSV file
        x = pd.read_csv(csv_file_path)
        x.drop(columns=['Unnamed: 2', 'Unnamed: 3', 'Unnamed: 4'], errors='ignore', inplace=True)
        x.rename(columns={'v1': 'result', 'v2': 'input'}, inplace=True)
        return jsonify(x.to_dict(orient='records'))
    except Exception as e:
        logging.error(f"Error fetching data: {e}")
        return jsonify({"error": str(e)}), 500

# Prediction route
@app.route('/predict', methods=['POST'])
def predict():
    try:
        if model is None or vectorizer is None:
            return jsonify({"error": "Model or vectorizer not loaded properly."}), 500

        data = request.json
        message = data.get('message', '').strip()

        if not message:
            return jsonify({"error": "No message provided"}), 400

        # Predict using the model
        message_vector = vectorizer.transform([message])
        prediction = model.predict(message_vector)[0]
        result = 'spam' if prediction == 1 else 'ham'

        return jsonify({"message": message, "result": result})
    except Exception as e:
        logging.error(f"Error classifying message: {e}")
        return jsonify({"error": f"Error classifying the message: {str(e)}"}), 500

if __name__ == '__main__':
    app.run(host='127.0.0.1', port=5000, debug=True)