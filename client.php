<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebAssistant</title>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --green: rgb(156, 175, 136);
            --dark-color: rgb(249, 248, 235);
            --black: #444;
            ---light-color: #666;
            --border: .1rem solid rgba(0, 0, 0, .1);
            --border-hover: .1rem solid var(--black);
            --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
            --outline: #666;
        }

        * {
            font-family: 'Alegreya', serif;
            font-style: normal;
            font-size: 2rem;
            margin: 0;
            padding: 0;
            outline: none;
            border: none;
            box-sizing: border-box;
            text-decoration: none;
            text-transform: capitalize;
            transition: all 0.8s linear;
            transition: width none;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
            scroll-padding-top: 5rem;
            scroll-behavior: smooth;
        }

        html::-webkit-scrollbar {
            width: 1rem;
        }

        html::-webkit-scrollbar-track {
            background: transparent;
        }

        html::-webkit-scrollbar-thumb {
            background: var(--black);
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: var(--green);
            font-weight: bold;
            font-size: 30px;
            text-decoration: underline;
            margin-top: 20px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            width: 80%;
        }

        #messages, #predefinedTexts {
            width: 45%;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
        }

        #messages {
            margin-right: 5%;
        }

        #predefinedTexts {
            margin-left: 5%;
        }

        .user-message {
            background-color: #d1e7dd;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .assistant-message {
            background-color: #e2e3e5;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .predefined-text {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #eaeaea;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .predefined-text:hover {
            background-color: #dcdcdc;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            #messages, #predefinedTexts {
                width: 90%;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <h1>Hello! How can I help you?</h1>
    <div class="container">
        <div id="messages">
            <!-- Example messages -->
            <div class="user-message">User: How do I search for flights, hotels, or vacation packages?</div>
            <div class="assistant-message">Assistant: You can search for flights, hotels, or vacation packages by...</div>
        </div>
        <div id="predefinedTexts">
            <div class="predefined-text" data-message="How do I search for available train tickets?">How do I search for available train tickets?</div>
            <div class="predefined-text" data-message="How can I create an account on your website?">How can I create an account on your website?</div>
            <div class="predefined-text" data-message="Can I modify or cancel my train ticket?">Can I modify or cancel my train ticket?</div>
            <div class="predefined-text" data-message="What is the cancellation policy for my train ticket?">What is the cancellation policy for my train ticket?</div>
            <div class="predefined-text" data-message="How do I contact customer support?">How do I contact customer support?</div>
            <div class="predefined-text" data-message="What should I do if I encounter issues while traveling?">What should I do if I encounter issues while traveling?</div>
            <div class="predefined-text" data-message="What should I pack for my trip?">What should I pack for my trip?</div>
           
            <div class="predefined-text" data-message="Why is your website not loading properly?">Why is your website not loading properly?</div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
