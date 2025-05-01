# SpamBlocker AI: ML-Based Text Spam Detection

SpamBlocker AI is a machine learning project designed to detect spam messages in SMS text using natural language processing techniques. It utilizes TF-IDF vectorization for feature extraction and Logistic Regression for classification. The model is trained on a labeled dataset of SMS messages and achieves high accuracy. This lightweight and efficient tool helps filter out unwanted texts with minimal setup and high reliability. It uses a Flask backend for predictions and an interactive front-end to classify user-inputted text messages as either "spam" or "ham" (not spam). The classifier is built using Python, Flask, and Scikit-learn, and is accessible through an intuitive web interface.

## Features

- **API Endpoints:**
  - `/fetch-data`: Fetch data from a CSV file.
  - `/predict`: Classify an Text message as spam or ham.
- **Interactive UI:** A simple, user-friendly interface to input and classify Text messages.
- **Dark Mode Support:** Toggleable dark mode for better user experience.

## Installation and Setup

### Prerequisites

- Python 3.7 or higher
- pip (Python package manager)

### Clone the Repository

```bash
git clone https://github.com/Mdfayjulkabir/SpamBlocker-AI___ML-Based-Text-Spam-Detection.git
cd SpamBlocker-AI___ML-Based-Text-Spam-Detection
```

### Install Dependencies

```bash
pip install -r requirements.txt
```

### Run the Application

```bash
python app.py
```

The application will start at `http://127.0.0.1:5000/`.

### Front-End Access
Open the `index.html` file in a browser to use the interactive SMS classifier UI.

## API Endpoints

### `/` (Home Route)

- **Method:** GET
- **Description:** Displays a welcome message.

### `/fetch-data`

- **Method:** GET
- **Description:** Fetches data from a local CSV file (`Text-spam.csv`).
- **Response:** JSON-formatted data from the CSV.

### `/predict`

- **Method:** POST
- **Description:** Classifies a given Text message.
- **Request Body:**
  ```json
  {
    "message": "Your text here"
  }
  ```
- **Response:**
  ```json
  {
    "message": "Your text here",
    "result": "spam"  // or "ham"
  }
  ```

## Front-End Features

### Dark Mode Toggle
- Users can toggle between light and dark modes for better readability.

### Real-Time Feedback
- Displays a progress bar as the user types.

### Classification Result
- Shows whether the entered message is spam or ham.

## Folder Structure

```
SpamBlocker-AI/
├── app.py               # Flask backend for API
├── templates/
│   └── index.html       # Front-end HTML file
├── static/
│   ├── styles.css       # CSS for styling
│   └── script.js        # JavaScript for UI interactions
├── model/
│   ├── Text_classifier.pkl   # Trained model
│   └── vectorizer.pkl        # TF-IDF vectorizer
├── requirements.txt     # Python dependencies
└── README.md            # Project documentation
```

## Future Enhancements

- **Model Optimization:** Improve accuracy with a larger dataset.
- **Advanced Features:** Include additional NLP preprocessing steps.
- **Deployment:** Host the app on platforms like Heroku or AWS.

## Contributing

Feel free to fork the repository and submit pull requests with improvements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

## Author

**Md Fayjul Kabir**  
[GitHub](https://github.com/Mdfayjulkabir)

