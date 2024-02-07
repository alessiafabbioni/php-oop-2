<?php

trait LoggerTrait {
    public function log($message) {
        echo "[" . date("Y-m-d H:i:s") . "] " . $message . PHP_EOL;
    }
}

class ShopException extends Exception {}

class Prodotto {
    use LoggerTrait;

    private $id;
    private $titolo;
    private $prezzo;
    private $categoria;
    private $tipoArticolo;

    public function __construct($id, $titolo, $prezzo, $categoria, $tipoArticolo) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->prezzo = $prezzo;

        // Validate and set the category
        $this->setCategoria($categoria);

        $this->tipoArticolo = $tipoArticolo;
    }

    private function setCategoria($categoria) {
        if (!$categoria instanceof Categoria) {
            $this->log("Invalid category provided for product '{$this->titolo}'.");
            throw new ShopException("Invalid category provided for product '{$this->titolo}'.");
        }
        $this->categoria = $categoria;
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
    use LoggerTrait;

    private $prodotti = [];

    public function aggiungiProdotto(Prodotto $prodotto) {
        $this->prodotti[] = $prodotto;
        $this->log("Product '{$prodotto->getTitolo()}' added to the store.");
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
    // ... (remaining product data)
];

try {
    foreach ($prodottiDaAggiungere as $prodottoData) {
        $prodotto = new Prodotto($prodottoData['id'], $prodottoData['titolo'], $prodottoData['prezzo'], $prodottoData['categoria'], $prodottoData['tipoArticolo']);
        $negozio->aggiungiProdotto($prodotto);
    }
} catch (ShopException $e) {
    echo 'Error: ' . $e->getMessage();
}

// Stampa html
foreach ($negozio->getProdotti() as $prodotto) {
    $prodotto->stampaCard();
}
?>
