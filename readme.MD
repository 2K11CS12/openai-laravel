# Laravel OpenAI Integration

![GitHub](https://img.shields.io/github/license/yourusername/laravel-openai)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/yourusername/laravel-openai)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/yourusername/laravel-openai/CI)

**Laravel OpenAI Integration** simplifies the integration of OpenAI's powerful language models into your Laravel application. This package provides a convenient way to interact with OpenAI for natural language processing and text generation tasks.

## Features

- Easy configuration of OpenAI API credentials.
- Simplified methods for generating text using OpenAI models.
- Customizable options for text generation.
- Seamless integration with your Laravel project.

## Installation

You can install this package via Composer. Run the following command in your Laravel project:

```bash
composer require yourusername/laravel-openai

## Configuration

```
OPENAI_API_KEY=your-api-key-here
OPENAI_API=https://api.openai.com/v1/chat/completions
OPENAI_MODEL=gpt-3.5-turbo

```
## Usage

```
// Import the OpenAI facade at the top of your file
use OpenAI;

// Generate text using the OpenAI model
$response = OpenAI::generateText('Write a short description of your usage here.');

// Handle the response as needed

```

```
$response = OpenAiLaravel::generate('Prompt', 1, ['key1', 'key2'])
    ->key('your-api-key')
    ->temperature(1.0)
    ->maxTokens(1000)
    ->topP(0.8)
    ->api('https://api.openai.com/v1/other/endpoint')
    ->model('custom-model')
    ->frequencyPenalty(0.5)
    ->presencePenalty(0.3)
    ->execute();
```

## Additional Options

```
$options = [
    'temperature' => 0.7,
    'max_tokens' => 50,
    // Add more options as needed
];

$response = OpenAI::generateText('Write a short description of your usage here.', $options);

```

## Contributing

<details-here>

## License

<details-here>

