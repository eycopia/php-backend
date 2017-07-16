<?php
namespace App;
error_reporting(0);
/*
 * Helper functions for building a DataTables server-side processing SQL query
 *
 * The static functions in this class are just helper functions to help build
 * the SQL used in the DataTables demo server-side processing scripts. These
 * functions obviously do not represent all that can be done with server-side
 * processing, they are intentionally simple to show how it works. More complex
 * server-side processing operations will likely require a custom script.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 * Modified by Jorge Copia
 */

class DatatableSsp {

    /**
     * Create the data output array for the DataTables rows
     *
     *  @param  array $columns Column information array
     *  @param  array $data    Data from the SQL get
     *  @return array          Formatted data in a row based format
     */
    static function data_output ( $columns, $data )
    {
        $out = array();
        for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
            $row = array();
            for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
                $column = $columns[$j];
                // Is there a formatter?
                if ( isset( $column['formatter'] ) ) {
                    $row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );
                }
                else {
                    $row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ] ;
                }
            }
            $out[] = $row;
        }
        return $out;
    }


    /**
     * Paging
     *
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     */
    static function limit ( $request, $columns)
    {
        $pagination = array('start' =>0, 'length'=>10);
        if ( isset($request['start']) && $request['length'] != -1 ) {
            $pagination['start'] = $request['start'];
            $pagination['length'] = $request['length'];
        }
        return $pagination;
    }


    /**
     * Ordering
     *
     * Construct the ORDER BY clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @return string SQL order by clause
     */
    static function order ( $request, $columns )
    {
        $order = array();
        if ( isset($request['order']) && count($request['order']) ) {
            for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
                // Convert the column index into the column data property
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                if ( $requestColumn['orderable'] == 'true' ) {
                    $dir = $request['order'][$i]['dir'] === 'asc' ?
                        'ASC' :
                        'DESC';
                    $column = $columns[$columnIdx];
                    $order[$column['db']] = $dir;
                }
            }
        }
        return $order;
    }


    /**
     * Searching / Filtering
     *
     * Construct the WHERE clause for server-side processing SQL query.
     *
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here performance on large
     * databases would be very poor
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @return string SQL where clause
     */
    static function filter ( $request, $columns )
    {
        $globalSearch =  array();
        $dtColumns = self::pluck( $columns, 'data' );
        if ( isset($request['search']) && $request['search']['value'] != '' ) {
            $str = trim($request['search']['value']);
            for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                $requestColumn = $request['columns'][$i];
                $column = $dtColumns[$i];
                    if ( $requestColumn['searchable'] == 'true' ) {
                        $globalSearch[$column] = $str;
                    }
            }
        }
        return  $globalSearch;
    }

    /**
     * Pull a particular property from each assoc. array in a numeric array,
     * returning and array of the property values from each item.
     *
     *  @param  array  $a    Array to get data from
     *  @param  string $prop Property to read
     *  @return array        Array of property values
     */
    static function pluck ( $a, $prop )
    {
        $out = array();
        for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
            $out[] = $a[$i][$prop];
        }
        return $out;
    }
}

