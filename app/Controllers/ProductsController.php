

<?php


class ProductsController
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Product();
    }

    public function index()
    {
        return view::load('product/index', ["products" => $this->conn->getAllProducts()]);
    }


    public function create()
    {
        return view::load('product/create');
    }


    public function store()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];


            $dataInsert = ["name" => $name, "description" => $description, "price" => $price, "qty" => $qty];

            if ($this->conn->insertProducts($dataInsert)) {
                return view::load('product/create', ["success" => "Data Added Successfully"]);
            } else {
                return view::load('product/create', ["error" => "Error"]);
            }
        }
        return view::load('product/create');
    }


    public function show($id)
    {
    }


    public function edit($id)
    {
        return view::load('product/edit', ["row" => $this->conn->getProduct($id)[0]]);
    }


    public function update()
    {


        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $id = $_POST['id'];

            $conn = new Product();
            $dataInsert = [
                "name" => $name,
                "description" => $description,
                "price" => $price,
                "qty" => $qty
            ];
            // data of product


            if ($conn->updateProduct($id, $dataInsert)) {
                view::load('product/edit', ["row" => $conn->getProduct($id)[0], 'success' => "Updated Successfully"]);
            } else {
                view::load('product/edit', ["row" => $conn->getProduct($id)[0], 'error' => "Error"]);
            }
        }
        // redirect('home/index');



    }





    public function destroy($id)
    {


        if ($this->conn->deleteProduct($id)) {
            return view::load('product/delete', ["success" => "Product Have Been Deleted"]);
        } else {
            return view::load('product/delete', ["error" => "Error"]);
        }
    }
}
