<?php

class Product extends DB
{
    private $id;
    private $sku;
    private $name;
    private $price;
    private $action;
    private $size;
    private $height;
    private $width;
    private $length;
    private $weight;

    private $property_id;

    const TABLE = "product";



    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length): void
    {
        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setPropertyId($property_id): void
    {
        $this->property_id = $property_id;
    }

    /**
     * @return mixed
     */
    public function getPropertyId()
    {
        return $this->property_id;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    public function first($id)
    {
        $result = $this->get($id);
        $this->id = $result->id;
        $this->sku = $result->name;
        $this->name = $result->type;
        $this->price = $result->price;
        $this->action = $result->action;
        $this->size = $result->size;
        $this->height = $result->height;
        $this->width = $result->width;
        $this->length = $result->length;
        $this->weight = $result->weight;

        return $this;
    }


    public function save()
    {

        $property = new DB('properties');
        $data = [
            "size" => $this->size,
            "height" => $this->height,
            "width" => $this->width,
            "length" => $this->length,
            "weight" => $this->weight,
            "action" => $this->action,
        ];
        $this->property_id = $property->insert($data);



        $data = [
            "sku" => $this->sku,
            "name" => $this->name,
            "price" => $this->price,
            "properties_id" => $this->property_id
        ];
         return $this->first($this->insert($data));
         

    }

    public function create()
    {
        $data = [
            "sku" => $this->sku,
            "name" => $this->name,
            "price" => $this->price,
            "action" => $this->action,
            "size" => $this->size,
            "height" => $this->height,
            "width" => $this->width,
            "length" => $this->length,
            "weight" => $this->weight
        ];

        $result = $this->insert($data);
        if (is_array($result)) {
            return $error = $result['error'];
        } else {
            $this->id = $result;
        }
    }

    public function delete($id)
    {
//        var_dump($id);
        $result = $this->remove($id);

        if (is_array($result)) {

            return false;
        } else {

            $this->id = $result;
            return $this->id;
        }
    }


}