<?php
//get all order
function getAllorder($db)
{
$sql = 'Select ID, orderdate, region, name, item, unit, unitcost, total from sample_data   ';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get order by id
function getorder($db, $ID)
{
$sql = 'Select ID, orderdate, region, name, item, unit, unitcost, total from sample_data   ';
$sql .= 'Where ID = :id';
$stmt = $db->prepare ($sql);
$id = (int) $ID;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new order
function createorder($db, $form_data) {
    $sql = 'Insert into sample_data (orderdate, region, name, item, unit, unitcost, total) ';
    $sql .= 'values (:orderdate, :region, :name, :item, :unit, :unitcost, :total)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':orderdate', $form_data['orderdate']);
    $stmt->bindParam(':region', $form_data['region']);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':item', $form_data['item']);
    $stmt->bindParam(':unit', $form_data['unit']);
    $stmt->bindParam(':unitcost', $form_data['unitcost']);
    $stmt->bindParam(':total', $form_data['total']);
    $stmt->execute();
    return $db->lastInsertID();//insert last number.. continue
    }

    //delete order by id
function deleteorder($db,$ID) {
    $sql = ' Delete from sample_data where ID = :id';
    $stmt = $db->prepare($sql);
    $id = (int)$ID;
    $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
    $stmt->execute();
    }

    //update order by id
function updateorder($db,$form_dat,$ID,$date) {
    $sql = 'UPDATE sample_data SET orderdate = :orderdate , region = :region , name = :name , item = :item , unit = :unit , unitcost = :unitcost , total = :total ';
    $sql .=' WHERE ID = :id';
    $stmt = $db->prepare ($sql);
    $id = (int)$ID;
    $mod = $date;
    $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
    $stmt->bindParam(':orderdate', $form_dat['orderdate']);
    $stmt->bindParam(':region', $form_dat['region']);
    $stmt->bindParam(':name', $form_dat['name']);
    $stmt->bindParam(':item', $form_dat['item']);
    $stmt->bindParam(':unit', $form_dat['unit']);
    $stmt->bindParam(':unitcost', $form_dat['unitcost']);
    $stmt->bindParam(':total', $form_dat['total']);
    $stmt->execute();
    }