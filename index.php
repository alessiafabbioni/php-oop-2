<?php

class Prodotto {
    private $id;
    private $titolo;
    private $prezzo;
    private $categoria;
    private $tipoArticolo;

    public function __construct($id, $titolo, $prezzo, $categoria, $tipoArticolo) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->prezzo = $prezzo;
        $this->categoria = $categoria;
        $this->tipoArticolo = $tipoArticolo;
    }

    public function stampaCard() {
        echo '<div class="card">';
        echo '<h2>' . $this->titolo . '</h2>';
        echo '<p>Prezzo: ' . $this->prezzo . ' EUR</p>';
        echo '<p>Categoria: ' . $this->categoria->getNome() . '</p>';
        echo '<p>Tipo di articolo: ' . $this->tipoArticolo . '</p>';
        echo '</div>';
    }

}

class Categoria {
    private $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }
}

class Negozio {
    private $prodotti = [];

    public function aggiungiProdotto(Prodotto $prodotto) {
        $this->prodotti[] = $prodotto;
    }

    public function getProdotti() {
        return $this->prodotti;
    }
}

// Negozio
$negozio = new Negozio();

$categorie = [
    new Categoria('Cani'),
    new Categoria('Gatti'),
];


$prodottiDaAggiungere = [
    ['id' => 1, 'titolo' => 'Crocchette al salmone', 'prezzo' => 10.99, 'categoria' => $categorie[0], 'tipoArticolo' => 'Cibo'],
    ['id' => 2, 'titolo' => 'Crocchette al manzo', 'prezzo' => 15.99, 'categoria' => $categorie[0], 'tipoArticolo' => 'Cibo'],
    ['id' => 3, 'titolo' => 'Crocchette al pollo', 'prezzo' => 19.99, 'categoria' => $categorie[0], 'tipoArticolo' => 'Cibo'],
    ['id' => 4, 'titolo' => 'Topino', 'prezzo' => 5.99, 'categoria' => $categorie[1], 'tipoArticolo' => 'Gioco'],
    ['id' => 5, 'titolo' => 'Pallina', 'prezzo' => 5.99, 'categoria' => $categorie[1], 'tipoArticolo' => 'Gioco'],
];


foreach ($prodottiDaAggiungere as $prodottoData) {
    $prodotto = new Prodotto($prodottoData['id'], $prodottoData['titolo'], $prodottoData['prezzo'], $prodottoData['categoria'], $prodottoData['tipoArticolo']);
    $negozio->aggiungiProdotto($prodotto);
}

// Stampa html
foreach ($negozio->getProdotti() as $prodotto) {
    $prodotto->stampaCard();
}


?>