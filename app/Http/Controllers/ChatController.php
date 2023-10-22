<?php

namespace App\Http\Controllers;

use OpenAI;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display the chatbot interface.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Render and display the chatbot interface view
        return view('chatbot');
    }


    /**
     * Handle user messages, send them to OpenAI, and manage chat history.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(Request $request)
    {
        // Get the user's message from the request
        $message = $request->input('message');

        // Send the user's message to OpenAI and receive a response
        $response = $this->sendToOpenAI($message);

        // Append the user and bot messages to the chat history
        $chatHistory = session('chatHistory', []);
        $chatHistory[] = ['role' => 'user', 'message' => $message];
        $chatHistory[] = ['role' => 'bot', 'message' => $response];

        // Store the updated chat history in the session
        session(['chatHistory' => $chatHistory]);

        // Redirect the user back to the chat interface
        return redirect('/');
    }

    /**
     * Send a user message to OpenAI's GPT-3.5 model and retrieve the bot's response using OpenAI SDK.
     *
     * This code uses the OpenAI PHP SDK to interact with the Chat API. It sends a user message to the GPT-3.5 model and retrieves the response.
     * Note: This code is commented out and not in use in this example.
     *
     * @param string $message The user's message
     * @return string The bot's response
     */
    /* private function sendToOpenAI($message)
    {
        // Use your OpenAI API credentials here
        $openai = new OpenAI([
            'key' => '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',
        ]);

        // Make a request to OpenAI's Chat API
        $response = $openai->chat->create([
            'messages' => [
                ['role' => 'system', 'content' => 'You are a chat bot.'],
                ['role' => 'user', 'content' => $message],
            ],
        ]);

        return $response['choices'][0]['message']['content'];
    } */

    /**
     * Send a user message to OpenAI's GPT-3.5 model and retrieve the bot's response.
     *
     * @param string $message The user's message
     * @return string The bot's response
     */
    private function sendToOpenAI($message)
    {
        // Set your OpenAI API key
        $api_key = env('OPENAI_API_KEY');

        // Define the API endpoint for OpenAI
        $endpoint = 'https://api.openai.com/v1/engines/davinci/completions';

        // Prepare the request data
        $data = [
            'prompt' => $message,
            'max_tokens' => 50,
        ];

        // Initialize Guzzle client for making HTTP requests
        $client = new Client();

        // Make the API request to OpenAI
        $response = $client->post($endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $api_key,
            ],
            'json' => $data,
        ]);

        // Get and decode the response content from OpenAI
        $responseContent = json_decode($response->getBody()->getContents(), true);

        // Extract and return the text of the bot's response
        return $responseContent['choices'][0]['text'];
    }
}
