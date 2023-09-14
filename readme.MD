# Laravel OpenAI Integration

![GitHub](https://img.shields.io/github/license/2K11CS12/laravel-openai)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/2K11CS12/laravel-openai)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/2K11CS12/laravel-openai/CI)

**Laravel OpenAI Integration** simplifies the integration of OpenAI's powerful language models into your Laravel application. This package provides a convenient way to interact with OpenAI for natural language processing and text generation tasks.

## Features

- Easy configuration of OpenAI API credentials.
- Simplified methods for generating text using OpenAI models.
- Customizable options for text generation.
- Seamless integration with your Laravel project.

## Installation

You can install this package via Composer. Run the following command in your Laravel project:

```bash
composer require Mangrio/laravel-openai
```
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
$response = OpenAiLaravel::generate('Prompt')
    ->key('your-api-key')
    ->temperature(1.0)
    ->maxTokens(1000)
    ->topP(0.8)
    ->model('custom-model')
    ->frequencyPenalty(0.5)
    ->presencePenalty(0.3)
    ->execute();
```

## Additional Options

## Contributing

## License