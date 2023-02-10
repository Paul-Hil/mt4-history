<x-header :data=$data></x-header>

<h3>Ajouter une nouvelle transaction</h3>
<form method="POST">
    @csrf
    <div>
        <label for="name">Forex / Crypto </label>
        <input type="text" id="name">
    </div>

    <div>
        <label for="price">Prix</label>
        <input type="number" id="price">
    </div>

    <div>
        <label for="quantity">Quantité</label>
        <input type="number" id="quantity">
    </div>

    <div>
        <label for="comment">Commentaire (Facultatif)</label>
        <input type="text" id="comment">
    </div>

    <div>
        <label for="date">Date</label>
        <input type="date" id="date">
    </div>

    <div>
        <input type="submit">
    </div>
</form>