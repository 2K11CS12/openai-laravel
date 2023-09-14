<?php

namespace Mangrio\OpenAiLaravel;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Mangrio\OpenAiLaravel\Models\OpenAiLaravelResponses;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

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
     * @return self
     */
    public function generate(string $prompt): self
    {
        // Create a new instance of the OpenAiLaravel class for chaining
        $instance = new self();
        $instance->override = $this->override; // Apply any overridden values

        // Set the prompt
        $instance->override['prompt'] = $prompt;

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
        $cacheKey = $this->generateCacheKey($this->override['prompt']);

        //return Cache::remember($cacheKey, now()->addMinutes(60), function () {
            $response = $this->fetchFromOpenAI();
            return $response;
            // Cache the response
            //return $this->cacheResponse($cacheKey, $response);
        //});
    }

    private function fetchFromOpenAI()
    {
        $openAiKey = $this->config['api_key'];
        $model = $this->config['model'];
        $apiUrl = $this->config['api_url'];

        // Merge the configuration values with overridden values
        $params = array_merge($this->config, $this->override);
        $implodedKeys = implode(', ', $params['keys']);

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$openAiKey}",
            'Content-Type' => 'application/json',
        ])->post($apiUrl, [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $params['prompt'],
                ],
            ],
            'model' => $model,
            'temperature' => 0,
            //'top_p' => 0.5
            //'temperature' => $params['temperature'],
            //'max_tokens' => (int) $params['max_tokens'],
            //'top_p' => $params['top_p'],
            //'frequency_penalty' => $params['frequency_penalty'],
            //'presence_penalty' => $params['presence_penalty'],
            //'stream' => true
        ])->json();
        
       //dd($response);

        return $response;
    }


    /**
     * Generate cache key.
     *
     * @return string hash.
     */
    private function generateCacheKey(string $prompt): string
    {
        return md5($prompt);
    }

    /**
     * Return the cached response from DB table.
     *
     * @return array The DB cached response.
     */
    private function cacheResponse(string $cacheKey, $response): array
    {
        if($this->config['preserve_response'] && $this->runMigration()){
            OpenAiLaravelResponses::create([
                'hashsum' => $cacheKey,
                'prompt' => trim($this->override['prompt']),
                'response' => json_encode($response),
            ]);
        }

        return $response;
    }
    
    
    /**
     * Run migrations.
     *
     * @return void
     */
    private function runMigration()
    {
        $migrationName = $this->config['preserve_response_migration'];
        $tableName = $this->config['preserve_response_table'];
    
        try {
            // Check if the migration has already been executed
            $status = Artisan::call('migrate:status', ['--path' => 'database/migrations']);
    
            if (!Schema::hasTable($tableName)) {
                logger('in !Schema');
                // The migration has not been executed, so run it
                Artisan::call('migrate', [
                    '--path' => 'database/migrations/' . $migrationName . '.php',
                ]);
    
                return true;
            } else {
                return true;
            }
        } catch (Exception $e) {
            // Handle any exceptions that occur during the migration
            //return "Error running migration: " . $e->getMessage();
            return false;
        }
    }
}
