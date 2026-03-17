<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AiAssistant extends BaseController
{
    /**
     * Handle incoming chat requests from the AI Assistant widget.
     */
    public function chat()
    {
        // Require POST method
        if (!$this->request->isAJAX() || $this->request->getMethod() !== 'post') {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request'
            ]);
        }

        $json = $this->request->getJSON();
        $message = strtolower(trim($json->message ?? ''));

        if (empty($message)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Message is empty'
            ]);
        }

        // Simulate AI Processing & Response logic based on user queries
        $reply = $this->generateAIResponse($message);

        // Simulated processing delay for realism (1-2 seconds)
        sleep(rand(1, 2));

        return $this->response->setJSON([
            'status' => 'success',
            'response' => $reply
        ]);
    }

    /**
     * Call the actual Gemini API
     */
    private function generateAIResponse(string $message): string
    {
        $apiKey = getenv('GEMINI_API_KEY');
        if (!$apiKey) {
            return "Maaf, kunci API Gemini belum dikonfigurasi pada `.env`. Tidak dapat memproses permintaan Anda.";
        }

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey;

        // Structured prompt to give the AI context and persona
        $systemInstruction = "Kamu adalah SIEM AI Assistant bernama 'SIEM Bot' berbahasa Indonesia. Tugasmu secara eksklusif berfokus pada: "
                           . "Keamanan Siber (Mitigasi Alert, Identifikasi Ancaman, Rekomendasi Pentest Web/Jaringan, Keamanan Endpoint) "
                           . "serta Persandian & Kriptografi (Sertifikat Elektronik, Hash, TTE). "
                           . "Panduan: "
                           . "1. Selalu balas dengan profesional, ringkas, format markdown (bullet points/bold). "
                           . "2. Buatkan to-do list terstruktur jika diminta solusi langkah demi langkah. "
                           . "3. Tolak dengan ramah bila pengguna menanyakan di luar konteks SIEM, IT Security, atau Kriptografi.\n\n"
                           . "Pertanyaan Pengguna: " . $message;

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $systemInstruction]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.3, // Low temperature for more focused, deterministic security answers
                'maxOutputTokens' => 800,
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || !$response) {
            return "Maaf, integrasi dengan Gemini AI saat ini mengalami gangguan (Error Code: $httpCode). " . ($response ? "Detail: " . substr($response, 0, 100) : "");
        }

        $data = json_decode($response, true);
        
        // Extracting text from standard Gemini API response format
        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return $data['candidates'][0]['content']['parts'][0]['text'];
        }

        return "Maaf, respons format dari API AI tidak terduga. Silakan coba lagi nanti.";
    }
}
