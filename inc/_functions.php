<?php

function viewResult( $table ) {

    global $db;
    $query = $db->prepare( "SELECT * FROM {$table}" );
    $query->execute();
    $result = $query->fetchAll();
    return $result;

}

function insertData( $table, $data ) {

    global $db;

    ksort( $data );

    $fieldNames  = implode( ',', array_keys( $data ) );
    $fieldValues = ':' . implode( ', :', array_keys( $data ) );
    $sql         = "INSERT INTO $table ($fieldNames) VALUES ({$fieldValues})";
    $sth         = $db->prepare( $sql );

    foreach ( $data as $key => $value ) {
        $sth->bindValue( ":$key", $value );
    }

    $sth->execute();

    $lastID = $db->lastInsertId();

    return $lastID;

}

function updateData( $table, $data, $where ) {

    global $db;

    ksort( $data );

    $fieldDetails = NULL;

    foreach ( $data as $key => $value ) {
        $fieldDetails .= "$key=:$key,";
    }

    $fieldDetails = rtrim( $fieldDetails, ',' );

    $sql = "UPDATE $table SET $fieldDetails WHERE $where";

    $sth = $db->prepare( $sql );

    foreach ( $data as $key => $value ) {
        $sth->bindValue( ":$key", $value );
    }

    return $sth->execute();

}

function idbyRequest( $table, $id, $request, $column = null ) {
    global $db;

    if ( $column ) {
        $c = $column;
    } else {
        $c = 'id';
    }

    $query = $db->prepare( "SELECT * FROM $table WHERE $c = :id" );
    $query->bindParam( ':id', $id, PDO::PARAM_INT );

    $query->execute();

    $queryResult = $query->fetch( PDO::FETCH_ASSOC );

    $result = $queryResult ? ($queryResult[$request] ?? '0') : '0';

    return $result;
}