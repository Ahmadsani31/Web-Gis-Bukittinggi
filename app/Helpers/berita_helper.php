<?php

function ArtikeTerpopuler($limit = 5)
{
    $sql = db_connect()->table('berita')->where('CURDATE()>=TanggalPublish AND Publish="Y"')->where(['DeletedAT' => null])->orderBy('View', 'DESC')->limit($limit)->get();
    if ($sql->getNumRows() > 0) {
        return $sql->getResultArray();
    }
}

function ArtikeTerbaru($limit)
{
    $sql = db_connect()->table('berita')->where('CURDATE()>=TanggalPublish AND Publish="Y"')->where(['DeletedAT' => null])->orderBy('TanggalPublish', 'DESC')->limit($limit)->get();
    if ($sql->getNumRows() > 0) {
        return $sql->getResultArray();
    }
}

function ArtikeHeadline($limit)
{
    $sql = db_connect()->table('berita')->where('CURDATE()>=TanggalPublish AND Publish="Y"')->where(['DeletedAT' => null])->where('Headline', 1)->orderBy('TanggalPublish', 'DESC')->limit($limit)->get();
    if ($sql->getNumRows() > 0) {
        return $sql->getResultArray();
    }
}
