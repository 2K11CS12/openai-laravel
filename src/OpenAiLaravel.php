<?php

namespace Mangrio\OpenAiLaravel;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Mangrio\OpenAiLaravel\Models\OpenAiLaravelResponses;

class OpenAiLaravel
{
    /**
     * Configuration values.
     *
     * @var array
     */
    private $config;

    /**
     * Overridden configuration values.
     *
     * @var array
     */
    private $override = [];

    /**
     * Constructor to initialize configuration.
     */
    public function __construct()
    {
        $this->config = config('openai-laravel');
    }

    /**
     * Start generating a response with the given prompt, count, and keys.
     *
     * @param string $prompt The prompt for text generation.
     * @param int $count The count of responses to generate.
     * @param array $keys The keys for data description.
     * @return self
     */
    public function generate(string $prompt, int $count = 1, array $keys): self
    {
        // Create a new instance of the OpenAiLaravel class for chaining
        $instance = new self();
        $instance->override = $this->override; // Apply any overridden values

        // Set the prompt, count, and keys
        $instance->override['prompt'] = $prompt;
        $instance->override['count'] = $count;
        $instance->override['keys'] = $keys;

        return $instance;
    }

    /**
     * Override the OpenAI API key for this API call.
     *
     * @param string $key The OpenAI API key to use for this call.
     * @return self
     */
    public function apiKey(string $key): self
    {
        // Apply the overridden key value
        $this->override['api_key'] = $key;

        return $this;
    }

    /**
     * Override the temperature parameter for text generation.
     *
     * @param float $value The temperature value to use for this call.
     * @return self
     */
    public function temperature(float $value): self
    {
        // Apply the overridden temperature value
        $this->override['temperature'] = $value;

        return $this;
    }

    /**
     * Override the maxTokens parameter for text generation.
     *
     * @param int $value The maxTokens value to use for this call.
     * @return self
     */
    public function maxTokens(int $value): self
    {
        // Apply the overridden maxTokens value
        $this->override['max_tokens'] = $value;

        return $this;
    }

    /**
     * Override the topP parameter for text generation.
     *
     * @param float $value The topP value to use for this call.
     * @return self
     */
    public function topP(float $value): self
    {
        // Apply the overridden topP value
        $this->override['top_p'] = $value;

        return $this;
    }

    /**
     * Override the API URL for this API call.
     *
     * @param string $apiUrl The custom API URL to use for this call.
     * @return self
     */
    public function apiUrl(string $apiUrl): self
    {
        // Apply the overridden API URL value
        $this->override['api_url'] = $apiUrl;

        return $this;
    }

    /**
     * Override the model to use for this API call.
     *
     * @param string $model The custom model to use for this call.
     * @return self
     */
    public function model(string $model): self
    {
        // Apply the overridden model value
        $this->override['model'] = $model;

        return $this;
    }

    /**
     * Override the frequency_penalty parameter for text generation.
     *
     * @param float $value The frequency_penalty value to use for this call.
     * @return self
     */
    public function frequencyPenalty(float $value): self
    {
        // Apply the overridden frequency_penalty value
        $this->override['frequency_penalty'] = $value;

        return $this;
    }

    /**
     * Override the presence_penalty parameter for text generation.
     *
     * @param float $value The presence_penalty value to use for this call.
     * @return self
     */
    public function presencePenalty(float $value): self
    {
        // Apply the overridden presence_penalty value
        $this->override['presence_penalty'] = $value;

        return $this;
    }

    /**
     * Execute the API call with the configured options and return the response.
     *
     * @return array The generated response.
     */
    public function execute(): array
    {
        $cacheKey = $this->generateCacheKey(
            $this->override['prompt'],
            $this->override['count'],
            $this->override['keys']
        );

        return Cache::remember($cacheKey, now()->addMinutes(60), function () {
            $response = $this->fetchFromOpenAI();
            // Cache the response
            return $this->cacheResponse($cacheKey, $response);
        });
    }
}
