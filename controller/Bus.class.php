<?php
class Bus extends Controller
{
    public function index()
    {
        $busModel = $this->loadModel('BusModel');
        $buses = $busModel->getAllBuses();
        $this->loadView('list_bus', ['buses' => $buses]);
    }
    
    public function getAllBuses()
    {
        $busModel = $this->loadModel('BusModel');
        $buses = $busModel->getAllBuses();
        while ($bus = $buses->fetch_assoc()) {
            echo $bus['name']; // Tampilkan data bus
        }
    }

    public function insert_form()
    {
        $this->loadView('bus_form');
    }

    public function insert_process()
    {
        $busModel = $this->loadModel('BusModel');
        $name = $_POST['name'];
        $type = $_POST['type'];
        $capacity = $_POST['capacity'];

        $busModel->insertBus($name, $type, $capacity);
        header("Location: ?c=Bus&m=list");
    }

    public function edit_form()
    {
        $id = $_GET['id'];
        $busModel = $this->loadModel('BusModel');
        $bus = $busModel->getBusById($id);
        $this->loadView('bus_form', ['bus' => $bus]);
    }

    public function edit_process()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $capacity = $_POST['capacity'];

        $busModel = $this->loadModel('BusModel');
        $busModel->updateBus($id, $name, $type, $capacity);
        header("Location: ?c=Bus&m=list");
    }

    public function delete()
    {
        $id = $_POST['id'];
        $busModel = $this->loadModel('BusModel');
        $busModel->deleteBus($id);
        header("Location: ?c=Bus&m=list");
    }
}
