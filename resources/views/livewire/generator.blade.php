<?php

use Livewire\Volt\Component;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Url;
use App\Models\WebhookRequest;
use Livewire\Attributes\Computed;

new class extends Component {
    
    public ?WebhookRequest $webhookRequest = null;
    
    public function createNewWebHook(): void
    {   
        $url = Url::create([
            'url' => $this->getSlug()
        ]);

        $this->urls[] = $url->url;
    }

    #[Computed]
    public function urls()
    {
        return Url::with('requests')->get();
    }

    public function setRequest($id)
    {
        $this->webhookRequest = WebhookRequest::find($id);
    }

    public function getSlug()
    {
        $personagens = [
            "Frodo Baggins",
            "Samwise Gamgee",
            "Gandalf",
            "Aragorn",
            "Legolas",
            "Gimli",
            "Boromir",
            "Meriadoc Brandybuck",
            "Peregrin Took",
            "Arwen",
            "Elrond",
            "Galadriel",
            "Éomer",
            "Éowyn",
            "Théoden",
            "Faramir",
            "Denethor",
            "Gollum",
            "Saruman",
            "Treebeard",
            "Bilbo Baggins",
            "Rosie Cotton",
            "Shelob",
            "Gríma Wormtongue",
            "Haldir",
            "Isildur",
            "Sauron",
            "Mouth of Sauron",
            "Witch-king of Angmar",
            "Tom Bombadil",
            "Goldberry"
        ];
        
        $personagem = Str($personagens[random_int(0, sizeof($personagens) -1)])->slug()->toString();

        if (Url::whereUrl($personagem)->exists()) {
            return $this->getSlug();
        }

        return $personagem;
    }

}; ?>

<div class="grid grid-cols-3 gap-4 h-full p-10">
    <div class="bg-slate-900 rounded-lg p-4">
        <button class="bg-yellow-500 rounded-lg shadow px-4 text-slate-900 hover:bg-opacity-80" wire:click="createNewWebHook">
            Novo WebHook
        </button>
    
        <ul class="overflow-y-auto h-[600px] text-lg flex flex-col space-y-2">
            @foreach ($this->urls as $url)
                <li>
                    <div class="flex justify-between">
                        {{ route('handle-requests', $url) }}
                        <a class="bg-yellow-500 rounded-lg shadow px-4 text-slate-900 hover:bg-opacity-80" href="{{ route('handle-requests', $url) }}?test=1" target="_blank">
                            test
                        </a>
                    </div>
                    <ul>
                        @foreach ($url->requests as $request)
                            <li class="cursor-pointer hover:text-yellow-300" wire:click="setRequest({{ $request->id }})">{{ $request->method }} :: {{ $request->created_at->diffForHumans() }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-slate-900 rounded-lg p-4 overflow-y-auto col-span-2">
        @if ($webhookRequest)
            <div class="">
                <div>{{ $webhookRequest->method }}</div>

                <div class="bg-slate-800 opacity-90 rounded-lg p-2 text-base mt-4 font-bold">
                    From IP {{ $webhookRequest->ip }} at {{ $webhookRequest->created_at->format('d, M h:i:s') }}
                </div>

                <div class="bg-slate-800 opacity-90 rounded-lg p-2 text-base mt-4 font-bold divide-y divide-amber-50 divide-opacity-20">
                    @foreach ($webhookRequest->headers as $header => $body)
                        <div class="grid grid-cols-6 py2">
                            <div>{{ $header }}</div>
                            <div class="col-span-4 text-wrap">{{ $body[0] }}</div>
                        </div>
                    @endforeach
                </div>
                <pre class="bg-slate-800 opacity-90 rounded-lg p-2 text-base mt-4">
                    {{ json_decode(json_encode($webhookRequest->body), JSON_PRETTY_PRINT) }}
                </pre>
            </div>
        @endif
    </div>
</div>
