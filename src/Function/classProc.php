<?php
//get all class
function getAllClass($db)
{
$sql = 'Select c.id, c.teacher_name, c.ic_num, c.subject_name, c.school_name from class c';
// $sql .='Inner Join students s on c.id = s.id';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//get class by id
function getClass($db, $classId)
{
$sql = 'Select c.id, c.teacher_name, c.ic_num, c.subject_name, c.school_name from class c ';
//$sql .='Inner Join students s on c.id = s.id ';
$sql .= 'Where c.id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $classId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

///////////////////////////////////////////////////////////////////////////

function createClass($db, $form_data)
{
    $sql = 'Insert into class (id, teacher_name, ic_num, subject_name, school_name) ';
    $sql .= 'values (:id, :teacher_name, :ic_num, :subject_name, :school_name)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':id', $form_data['id']);
    $stmt->bindParam(':teacher_name', $form_data['teacher_name']);
    $stmt->bindParam(':ic_num', $form_data['ic_num']);
    $stmt->bindParam(':subject_name', $form_data['subject_name']);
    $stmt->bindParam(':school_name', $form_data['school_name']);
    $stmt->execute();
    return $db->lastInsertID();
    //insert last number.. continue
}
///////////////////////////////////////////////////////////////////////////////

//delete product by id
function deleteClass($db,$classId) {
$sql = ' Delete from class where id = :id';
$stmt = $db->prepare($sql);
$id = (int)$classId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
}


////////////////////////////////////////////////////////////////////////////////

//update product by id
function updateClass ($db, $form_dat, $classId, $date) {
    $sql = 'UPDATE class SET id = :id , teacher_name = :teacher_name , ic_num = :ic_num , subject_name = :subject_name , school_name = :school_name';
    $sql .=' WHERE id = :id';
    
    $stmt = $db->prepare ($sql);
    $id = (int)$classId;
    $mod = $date;
    
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':teacher_name', $form_dat['teacher_name']);
    $stmt->bindParam(':ic_num', $form_dat['ic_num']);
    $stmt->bindParam(':subject_name', $form_dat['subject_name']);
    $stmt->bindParam(':school_name', $form_dat['school_name']);
    $stmt->bindParam(':modified', $mod , PDO::PARAM_STR);
    $stmt->execute();

}