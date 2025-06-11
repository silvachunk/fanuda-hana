<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fan;
use Illuminate\Support\Facades\Log;

class HanaController extends Controller
{
    public function respond(Request $request)
    {
        // Validate input
        $request->validate([
            'fan_id' => 'required|integer',
            'message' => 'required|string'
        ]);

        $fan = Fan::with(['memories', 'trustEvents', 'boundaries'])->find($request->fan_id);

        if (!$fan) {
            return response()->json(['error' => 'Fan not found'], 404);
        }

        // Boundary check (cam/voice/spam...)
        $violation = $this->detectViolation($request->message);
        if ($violation) {
            $fan->boundaries()->create([
                'violation' => $violation,
                'message' => $request->message
            ]);

            return response()->json([
                'reply' => "One sec… let me find something for you. ❤️", 
                'alert' => 'Staff notified of boundary trigger.'
            ]);
        }

        // Save memory with mood tag
        $mood = $this->detectMood($request->message);
        $fan->memories()->create([
            'type' => 'message',
            'content' => $request->message,
            'mood' => $mood,
            'remembered_at' => now()
        ]);

        // Pull a flirt memory callback
        $memory = $fan->memories->where('type', 'flirt')->first();
        $trust = $fan->trust_score;

        // Simulated AI reply
        $response = "Hey {$fan->name}";
        if ($trust >= 6) {
            $response .= ", baby";
        }

        if ($memory) {
            $response .= ", still thinking about when you said: '{$memory->content}' 😘";
        } else {
            $response .= ", I’ve been waiting to hear from you again… 💫";
        }

        // Trust logic
        $fan->trustEvents()->create([
            'delta' => 1,
            'reason' => 'engaged respectfully'
        ]);
        $fan->increment('trust_score');

        return response()->json([
            'reply' => $response,
            'trust_score' => $fan->trust_score
        ]);
    }

    protected function detectViolation($message)
    {
        $msg = strtolower($message);
        if (str_contains($msg, 'cam')) return 'cam_request';
        if (str_contains($msg, 'voice')) return 'voice_request';
        if (str_contains($msg, 'pic') || str_contains($msg, 'image')) return 'image_upload';
        if (str_contains($msg, 'fuck') || str_contains($msg, 'dumb')) return 'aggression';
        return null;
    }

    protected function detectMood($message)
    {
        $msg = strtolower($message);

        if (str_contains($msg, 'miss') || str_contains($msg, 'lonely')) return 'vulnerable';
        if (str_contains($msg, 'hot') || str_contains($msg, 'turn on')) return 'horny';
        if (str_contains($msg, 'love') || str_contains($msg, 'sweet')) return 'affectionate';
        if (str_contains($msg, 'haha') || str_contains($msg, 'fun')) return 'playful';

        return 'neutral';
    }
}
