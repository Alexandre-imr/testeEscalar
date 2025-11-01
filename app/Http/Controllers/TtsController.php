<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use Illuminate\Support\Facades\File;

class TtsController extends Controller
{
   
    public function index()
    {
        return view('TesteEscalar', ['audio_url' => null, 'original_text' => null]);
    }

    // Processa o texto enviado e gera a URL do áudio.
    public function speak(Request $request)
    {
 
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $text = $request->input('text');
        $lang = 'pt-BR';
        $texto_para_url = urlencode($text);

      
        $url = "https://translate.google.com/translate_tts?ie=UTF-8&client=tw-ob&tl={$lang}&q={$texto_para_url}";


        $response = Http::get($url); 

        if ($response->successful()) {
           
            $dados_do_audio = $response->body(); 

           
            $directoryPath = public_path('audio');
            $filePath = $directoryPath . '/latest.mp3';

           
            File::ensureDirectoryExists($directoryPath);
            
       
            File::put($filePath, $dados_do_audio);

         
            $audio_local = asset('audio/latest.mp3') . '?t=' . time();

           
            return view('TesteEscalar', [
                'audio_url' => $audio_local,
                'original_text' => $text
            ]);

        } else {
         
            return back()->withErrors(['text' => 'Não foi possível gerar o áudio. Tente novamente.']);
        }
    }
}