<?php

use Livewire\Volt\Component;
use Illuminate\Support\Str;
use App\Models\Url;

new class extends Component {

    public array $urls = [];

    public function mount():void
    {
        $this->urls = Url::select(['url'])->get()->flatten()->map(fn($i) => $i['url'])->toArray();
    }
    
    public function createNewWebHook(): void
    {   
        $url = Url::create([
            'url' => $this->getSlug()
        ]);

        $this->urls[] = $url->url;
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

<div class="grid grid-cols-2 gap-4 h-full p-10">
    <div class="bg-slate-900 rounded-lg p-4">
        <button class="bg-yellow-500 rounded-lg shadow px-4 text-slate-900 hover:bg-opacity-80" wire:click="createNewWebHook">
            Novo WebHook
        </button>
    
        <ul class="overflow-y-auto h-[600px]">
            @foreach ($urls as $url)
                <li>{{ $url }}</li>
            @endforeach
        </ul>
    </div>

    <div class="bg-slate-900 rounded-lg p-4 overflow-y-auto">

    </div>
</div>
