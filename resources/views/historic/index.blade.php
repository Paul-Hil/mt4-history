<x-header :data=$data></x-header>

<a href="{{ route('historic.add') }}"><button>Ajouter</button></a>
<button>Supprimer</button>

@if(isset($historic))


@endif