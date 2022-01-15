<?php
namespace PhpNv\Data;

/**
 * @author Heiler Nova.
 */
class Query
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * Ejecuta un insert en la base de datos.
     * @param array $params array asosiativo de los valor de inserción
     * @param string $table Nombre de la tabla a la cual se le insertaran los datos.
     */
    public function insert(array $params, string $table):bool
    {
        $sql = nv_db_stmt_sql_insert(array_keys((array)$params), $table);

        return $this->database->execute($sql, (array)$params);
    }
}