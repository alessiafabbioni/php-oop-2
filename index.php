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


?>