<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileConvertionController extends Controller
{
    // get file from endpoint
    public function getFile()
    {
        // initialize curl details
        $url = "https://test.hiskenya.org/api/analytics.json?dimension=dx%3AotgQMOXuyIn%3BM4RzpOew1Im%3ByQFyyQBhXQf&dimension=pe%3A202301%3B202302%3B202303%3B202304%3B202305%3B202306%3B202307%3B202308%3B202309%3B202310%63B202311%3B202312&tableLayout=true&columns=dx&rows=pe&skipRounding=false&completedOnlY=false&filter=ou%3AUSER_ORGUNIT"; 
        $username = 'programmingtest'; 
        $password = 'Kenya@2040';

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // Execute cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Check if request was successful
        if ($response === false) {
            return response()->json(['error' => 'Failed to fetch file'], 500);
        }

        // Parse the received file
        $data = json_decode($response, true);
        
        // Check for JSON decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Failed to decode JSON response: ' . json_last_error_msg()], 500);
        }

        if (!$data) {
            return response()->json(['error' => 'Failed to parse file'], 500);
        }

        // Extract headers
        $headers = array_column($data['headers'], 'name');

        // Extract rows
        $rows = $data['rows'];

        // Create CSV content
        $csvData = implode(',', array_map('self::escapeCsvField', $headers)) . "\n";
        foreach ($rows as $row) {
            $csvData .= implode(',', array_map('self::escapeCsvField', $row)) . "\n";
        }

        // Store CSV locally
        $filePath = public_path('data.csv');
        file_put_contents($filePath, $csvData);

        return response()->json(['message' => 'CSV file saved successfully']);
    }

    
private static function escapeCsvField($value)
{
    // Escape double quotes
    $value = str_replace('"', '""', $value);

    // Enclose value in double quotes if it contains a comma, double quote, or newline
    if (strpos($value, ',') !== false || strpos($value, '"') !== false || strpos($value, "\n") !== false) {
        $value = '"' . $value . '"';
    }

    return $value;
}
}
