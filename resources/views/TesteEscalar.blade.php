<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Prático - Text-to-Speech</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/meu-estilo.css') }}">
</head>
<body>
    <div class="container p-4 p-md-5">
        
        <h1 class="h3 mb-4 text-center fw-bold"> 📊Teste Escalar📊
</h1>
        
        <form action="{{ route('tts.speak') }}" method="POST">
            @csrf <div class="mb-3">
                <label for="text" class="form-label">Digite seu texto:</label>
                
                <textarea class="form-control" 
                          id="text" 
                          name="text" 
                          rows="4" 
                          required 
                          maxlength="255">{{ $original_text ?? '' }}</textarea>

                @error('text')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    Gerar Voz
                </button>
            </div>
        </form>

        @if (isset($audio_url))
            <hr class="my-4">
            <div class="text-center">
                <h5 class="mb-3">Ouvindo agora:</h5>
                <p class="fst-italic text-muted">"{{ $original_text }}"</p>
                
                <audio controls autoplay class="w-100">
                    <source src="{{ $audio_url }}" type="audio/mpeg">
                    Seu navegador não suporta o elemento de áudio.
                </audio>
            </div>
        @endif
        
        <footer class="text-center text-muted mt-4">
            <small>Projeto de Teste por Alexandre Inácio</small>
        </footer>
    </div>
</body>
</html>