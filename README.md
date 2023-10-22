## Prerequisites

    PHP (>= 8.0)
    Composer
    Laravel (>= 8.0)
    OpenAI API Key (You will need an OpenAI API key to use this chatbot)

## Installation

    1.Clone the repository:
        git clone https://github.com/yourusername/your-chatbot-repo.git

    2.Change directory to the project folder:
        cd chatbot

    3.Install project dependencies using Composer:
        run composer install

    4.Create a copy of the .env file and set your OpenAI API key:
        cp .env.example .env

    5.Open the .env file and add your OpenAI API key:
        OPENAI_API_KEY=your-api-key

    6.Generate an application key:
        run php artisan key:generate

    7.Include Guzzle package to connect with openai
        run composer require guzzlehttp/guzzle

    8.Start the development server:
        php artisan serve

## How to Use

    Visit the application in your web browser via localhost and you will see a basic chat interface.
    Type in your message and click submit to send your message to the api.
    The data gets retrieved from the API will be displayed on the page as a response.

## Using Openai package instead of guzzle

    run composer require openai/openai
    However, if you face compatibility issues, change "minimum-stability": "stable" to "minimum-stability": "dev" in your composer.json, run composer update then rerun the command above.
    *I first used this but it wasn't installed correctly even after fixing compatibility issues thus finding an
    alternative by using guzzle instead.
