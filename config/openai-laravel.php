<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    | This key is used to authenticate with the OpenAI API for making requests.
    | You can obtain it from your OpenAI account. If not provided, it defaults to an empty string.
    */
    'api_key' => env('OPENAI_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Endpoint
    |--------------------------------------------------------------------------
    | This is the URL of the OpenAI API endpoint used for making requests.
    | It defaults to the official endpoint but can be customized if needed.
    */
    'api_url' => env('OPENAI_API_URL', 'https://api.openai.com/v1/chat/completions'),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Model
    |--------------------------------------------------------------------------
    | Specifies the OpenAI language model to use for generating text.
    | The default is 'gpt-3.5-turbo', which is a powerful model suitable for most use cases.
    */
    'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Temperature
    |--------------------------------------------------------------------------
    | Controls the randomness of text generation. Higher values (e.g., 1.0) make the output more random,
    | while lower values (e.g., 0.2) make it more deterministic.
    | Default is 0.5 for a balanced output.
    */
    'temperature' => env('OPENAI_TEMPERATURE', 0.5),

    /*
    |--------------------------------------------------------------------------
    | Maximum Tokens
    |--------------------------------------------------------------------------
    | Sets the maximum number of tokens in the generated response.
    | The default value is 4096, but it can be adjusted according to your requirements.
    */
    'max_tokens' => env('OPENAI_MAX_TOKENS', 4087),

    /*
    |--------------------------------------------------------------------------
    | Top-p Sampling
    |--------------------------------------------------------------------------
    | Determines the probability threshold for generating text. A higher value (e.g., 1) is more conservative,
    | while a lower value (e.g., 0.8) allows for more diverse responses.
    | Default is 1 for full sampling.
    */
    'top_p' => env('OPENAI_TOP_P', 1),

    /*
    |--------------------------------------------------------------------------
    | Frequency Penalty
    |--------------------------------------------------------------------------
    | Adjusts the model's tendency to repeat the same phrases or words.
    | A positive value encourages diversity, while a negative value encourages repetition.
    | Default is 0, meaning no penalty.
    */
    'frequency_penalty' => env('OPENAI_FREQUENCY_PENALTY', 0),

    /*
    |--------------------------------------------------------------------------
    | Presence Penalty
    |--------------------------------------------------------------------------
    | Adjusts the model's tendency to stay on a specific topic or theme.
    | A positive value encourages the model to explore more topics, while a negative value narrows it down.
    | Default is 0, meaning no penalty.
    */
    'presence_penalty' => env('OPENAI_PRESENCE_PENALTY', 0),

    /*
    |--------------------------------------------------------------------------
    | Prserve OpenAI API response in DB
    |--------------------------------------------------------------------------
    |
    */
    'preserve_response' => env('OPENAI_PRESERVE_RESPONSE', 0),
    
    /*
    |--------------------------------------------------------------------------
    | Prseve migration file name
    |--------------------------------------------------------------------------
    |
    */
    'preserve_response_migration' => env('OPENAI_PRESERVE_RESPONSE_MIGRATION', 'create_openai_laravel_responses_table'),
    
    /*
    |--------------------------------------------------------------------------
    | Prseve DB table name
    |--------------------------------------------------------------------------
    |
    */
    'preserve_response_table' => env('OPENAI_PRESERVE_RESPONSE_table', 'open_ai_laravel_responses')
];
