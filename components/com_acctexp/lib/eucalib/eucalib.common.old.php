<?php

/**
* jsonized Database Table entry
*
* For use with as an abstract class that adds onto table entries
*/
class jsonDBTable extends paramDBTable
{
	function storeload()
	{
		$this->check();
		$this->store( true );

		return $this->load( $this->id );
	}

	/**
	 * Receive Parameters and decode them into an array
	 * @return array
	 */
	function getParams( $field = 'params' )
	{
		if ( empty( $this->$field ) ) {
			return null;
		}

		return jsoonHandler::decode( stripslashes( $this->$field ) );
	}

	/**
	 * Encode array and set Parameter field
	 */
	function setParams( $input, $field = 'params' )
	{
		if ( !empty( $field ) && ( $input != 'null' ) ) {
			if ( get_magic_quotes_gpc() ) {
				$store = jsonDBTable::multistripslashes( $input );
			} else {
				$store = $input;
			}
			$this->$field = $this->_db->getEscaped( jsoonHandler::encode( $store ) );
		} else {
			$this->$field = null;
		}
		return true;
	}

	function multistripslashes( $input )
	{
		if ( is_object( $input ) ) {
			$properties = get_object_vars( $input );

			foreach ( $properties as $pname => $pvalue ) {
				$input->$pname = jsonDBTable::multistripslashes( $pvalue );
			}
		} elseif ( is_array( $input ) ) {
			foreach ( $input as $pname => $pvalue ) {
				$input[$pname] = jsonDBTable::multistripslashes( $pvalue );
			}
		} else {
			$input = stripslashes( $input );
		}

		return $input;
	}

	/**
	 * Add an array of Parameters to an existing parameter field
	 */
	function addParams( $params, $field = 'params', $overwrite = true )
	{
		if ( empty( $this->$field ) || ( $this->$field == 'null' ) ) {
			$this->$field = $params;
		} elseif ( gettype( $this->$field ) == gettype( $params ) ) {
			$this->$field = jsonDBTable::mergeParams( $this->$field, $params, $overwrite );
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Recursive Merging of two Entities, regardless of type
	 */
	function mergeParams( $subject, $subject2, $overwrite=true )
	{
		if ( is_object( $subject ) ) {
			$properties = get_object_vars( $subject2 );

			foreach ( $properties as $pname => $pvalue ) {
				if ( !isset( $subject->$pname ) ) {
					$subject->$pname = $pvalue;
				} elseif ( isset( $subject->$pname ) && $overwrite ) {
					$subject->$pname = jsonDBTable::mergeParams( $subject->$pname, $pvalue, $overwrite );
				}
			}
		} elseif ( is_array( $subject ) ) {
			foreach ( $subject2 as $pname => $pvalue ) {
				if ( !isset( $subject[$pname] ) ) {
					$subject[$pname] = $pvalue;
				} elseif ( isset( $subject[$pname] ) && $overwrite ) {
					$subject[$pname] = jsonDBTable::mergeParams( $subject[$pname], $pvalue, $overwrite );
				}
			}
		} else {
			if ( $overwrite ) {
				$subject = $subject2;
			}
		}

		return $subject;
	}

	/**
	 * Delete a set of Parameters providing an array of key names
	 */
	function delParams( $array, $field = 'params' )
	{

	}

	/**
	 * Return the differences between a new set of Parameters and the existing one
	 */
	function diffParams( $array, $field = 'params' )
	{

	}

	function load( $id, $jsonfields=array() )
	{
		if ( method_exists( $this, 'declareJSONfields' ) ) {
			$jsonfields = array_merge( $jsonfields, $this->declareJSONfields() );
		}

		parent::load( $id );

		if ( !empty( $jsonfields ) ) {
			foreach ( $jsonfields as $fieldname ) {
				$this->$fieldname = $this->getParams( $fieldname );
			}
		}

		return true;
	}

	function check( $jsonfields=array() )
	{
		if ( method_exists( $this, 'declareJSONfields' ) ) {
			$jsonfields = array_merge( $jsonfields, $this->declareJSONfields() );
		}

		if ( !empty( $jsonfields ) ) {
			foreach ( $jsonfields as $fieldname ) {
				if ( !empty( $this->$fieldname ) && ( $this->$fieldname != 'null' ) ) {
					$this->setParams( $this->$fieldname, $fieldname );
				} else {
					unset( $this->$fieldname );
				}
			}
		}

		return true;
	}

}

class languageFileHandler
{
	function languageFileHandler( $filepath ) {
		$this->filepath = $filepath;
	}

	function getConstantsArray() {

		$file = fopen( $this->filepath, "r" );

		$array = array();
		while ( !feof( $file ) ) {
			$buffer = fgets($file, 4096);
			if ( strpos( $buffer, 'define') !== false ) {
				$linearray = explode( '\'', $buffer );
				if ( count( $linearray ) === 5 ) {
					$array[$linearray[1]] = $linearray[3];
				}
			}
    	}

		return $array;
	}

	function getHTML() {

		$file = fopen( $this->filepath, "r" );

		$array = array();
		while ( !feof( $file ) ) {
			$buffer = fgets($file, 4096);
			if ( strpos( $buffer, 'define') !== false ) {
				$linearray = explode( '\'', $buffer );
				if ( count( $linearray ) === 5 ) {
					$array[$linearray[1]] = $linearray[3];
				}
			}
    	}

		return $array;
	}
}
?>
