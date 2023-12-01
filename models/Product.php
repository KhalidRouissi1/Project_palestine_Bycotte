
<?php
class Product {
    private $title, $description, $reasonOfBycoot, $productImg,$isApproved;

    public function __construct($title = "", $description = "", $reasonOfBycoot = "", $productImg = "") {
        $this->title = $title;
        $this->description = $description;
        $this->reasonOfBycoot = $reasonOfBycoot;
        $this->productImg = $productImg;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getReasonOfBycoot() {
        return $this->reasonOfBycoot;
    }

    public function getProductImg() {
        return $this->productImg;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setReasonOfBycoot($reasonOfBycoot) {
        $this->reasonOfBycoot = $reasonOfBycoot;
    }

    public function setProductImg($productImg) {
        $this->productImg = $productImg;
    }
}
