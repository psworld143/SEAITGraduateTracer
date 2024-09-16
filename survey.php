<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Survey Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .survey-form-container {
            max-width: 600px;
            width: 100%;
            margin: 20px;
        }
        .survey-form {
            background-color: rgba(255, 255, 255, 0.5); 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #34495e;
        }
        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9f9f9;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            border-color: #3498db;
        }
        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 10px;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        button:hover {
            background-color: #2980b9;
        }
        .progress-bar {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .progress {
            width: 0;
            height: 10px;
            background-color: #2ecc71;
            border-radius: 4px;
            transition: width 0.3s ease;
        }
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            .survey-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="survey-form-container">
        <div class="survey-form">
            <h1>SEAITGraduateTracer</h1>
            <br>
            <hr>
            <br>
            <form id="customSurvey">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    
                        <input type="number" class="form-control">
                    
                </div>
                <div class="form-group">
                    <label>How satisfied are you with our service?</label>
                    <div>
                        <input type="radio" id="very-satisfied" name="satisfaction" value="very-satisfied">
                        <label for="very-satisfied">Very Satisfied</label>
                    </div>
                    <div>
                        <input type="radio" id="satisfied" name="satisfaction" value="satisfied">
                        <label for="satisfied">Satisfied</label>
                    </div>
                    <div>
                        <input type="radio" id="neutral" name="satisfaction" value="neutral">
                        <label for="neutral">Neutral</label>
                    </div>
                    <div>
                        <input type="radio" id="dissatisfied" name="satisfaction" value="dissatisfied">
                        <label for="dissatisfied">Dissatisfied</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comments">Additional Comments:</label>
                    <textarea id="comments" name="comments" rows="4" placeholder="Share your thoughts..."></textarea>
                </div>
            </form>
        </div>
        <br>
        <div style="display: flex; gap: 300px;">
            <button type="submit">Submit</button>
            <button type="submit">Clear Form</button>
        </div>
    </div>
</body>
</html>
