<?php
/**
 * @version $Id: mammontini.php
 * @package Mammontini!: General purpose Payment-related functionality
 * @copyright Copyright (C) 2008 David Deutsch, All Rights Reserved
 * @author David Deutsch <skore@skore.de>
 * @license GNU/GPL v.2 or later http://www.gnu.org/copyleft/gpl.html
 *
 *          _  _ ____ _  _ _  _ ____ __ _ ___ _ __ _ _  /
 *          |\/| |--| |\/| |\/| [__] | \|  |  | | \| | .  v1.0
 *
 * The lean library for the big money processing named after squirrels.
 */

/**
 * Terms Object, collation of a full payment description
 *
 * @author	David Deutsch <mails@valanx.org>
 * @package		AEC Component
 * @subpackage	Library - Mammontini!
 * @since 1.0
 */
class mammonTerms extends eucaObject
{
	/**
	 * Do the terms include a Trial?
	 *
	 * @var bool
	 */
	var $hasTrial	= null;

	/**
	 * Is it free?
	 *
	 * @var bool
	 */
	var $free		= null;

	/**
	 * Remember where the application is at
	 *
	 * @var int
	 */
	var $pointer	= 0;

	/**
	 * Term array
	 *
	 * @var array
	 */
	var $terms		= array();

	/**
	 * Read old style parameters into new style terms
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.0
	 */
	function readParams( $params, $allow_trial=true )
	{
		// Old params only had trial and full
		if ( $allow_trial ) {
			$terms	= array( 'trial_', 'full_' );
		} else {
			$terms	= array( 'full_' );
		}

		$return	= false;

		$this->pointer = 0;

		foreach ( $terms as $t ) {
			// Make sure this period is actually of substance
			if ( !empty( $params[$t.'period'] ) || ( !empty( $params['lifetime'] ) && ( $t == 'full_' ) ) ) {
				$term = new mammonTerm();

				// If we have a trial, we need to mark this
				if ( $t == 'trial_' ) {
					$this->set( 'hasTrial', true );
					$term->set( 'type', 'trial' );
				} else {
					$term->set( 'type', 'term' );
				}

				if ( $t != 'trial_' && !empty( $params['lifetime'] ) ) {
					$duration['lifetime']	= true;
				} else {
					$duration['period']		= $params[$t.'period'];
					$duration['unit']		= $params[$t.'periodunit'];
				}

				$term->set( 'duration', $duration );

				if ( $params[$t.'free'] ) {
					$term->addCost( '0.00' );
				} else {
					$term->addCost( $params[$t.'amount'] );
				}

				$this->addTerm( $term );
				$return = true;
			}
		}

		$free = true;
		foreach ( $this->terms as $term ) {
			if ( empty( $term->free ) ) {
				$free = false;
			}
		}

		$this->free = $free;

		$this->nextterm =& $this->terms[$this->pointer];

		return $return;
	}

	/**
	 * Create old style moun from new style terms
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.0
	 */
	function getOldAmount( $recurring=true )
	{
		$amount = array();

		$apointer = 0;
		foreach ( $this->terms as $tid => $term ) {
			$apointer++;
			if ( $tid < $this->pointer ) {
				continue;
			}

			$i = $apointer;

			if ( count( $this->terms ) == 1 ) {
				$i = 3;
			} elseif ( count( $this->terms ) == 2 ) {
				if ( $i == 2 ) {
					$i = 3;
				}
			}

			if ( $recurring ) {
				$amount['amount'.$i]	= $term->renderTotal();
				$amount['period'.$i]	= $term->duration['period'];
				$amount['unit'.$i]		= $term->duration['unit'];
			} else {
				$amount = $term->renderTotal();

				// Only render "next" amount
				return $amount;
			}
		}

		return $amount;
	}

	/**
	 * increment Terms Array pointer
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.0
	 */
	function incrementPointer( $amount=1 )
	{
		for ( $i=0; $i<$amount; $i++ ) {
			if ( $this->pointer < ( count( $this->terms ) - 1 ) ) {
				$this->pointer++;
			}
		}

		$this->nextterm =& $this->terms[$this->pointer];
	}

	/**
	 * decrement Terms Array pointer
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.0
	 */
	function decrementPointer( $amount=1 )
	{
		for ( $i=0; $i<$amount; $i++ ) {
			if ( $this->pointer > 0 ) {
				$this->pointer--;
			}
		}

		$this->nextterm =& $this->terms[$this->pointer];
	}

	/**
	 * set Terms Array pointer
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.0
	 */
	function setPointer( $pointer )
	{
		if ( empty( $pointer ) ) {
			$pointer = 0;
		}

		if ( $pointer < ( count( $this->terms ) ) ) {
			$this->pointer = $pointer;
		} else {
			$this->pointer = count( $this->terms ) - 1;
		}

		$this->nextterm =& $this->terms[$this->pointer];
	}

	/**
	 * add Term to Terms Array
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.0
	 */
	function addTerm( $term )
	{
		array_push( $this->terms, $term );
	}

	/**
	 * get Terms Array
	 *
	 * @access	public
	 * @return	boolean	True on success
	 * @since	1.0
	 */
	function getTerms()
	{
		return $this->terms;
	}

	/**
	 * check whether this costs nothing
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function checkFree()
	{
		$free = true;
		foreach ( $this->terms as $term ) {
			if ( empty( $term->free ) ) {
				$free = false;
			}
		}

		$this->free = $free;

		return $this->free;
	}
}

/**
 * Term Object, representing one Term in a payment description
 *
 * @author	David Deutsch <mails@valanx.org>
 * @package		AEC Component
 * @subpackage	Library - Mammontini!
 * @since 1.0
 */
class mammonTerm extends eucaObject
{
	/**
	 * Term type
	 *
	 * Regular values: trial, standard
	 *
	 * @var string
	 */
	var $type			= null;

	/**
	 * Term start
	 *
	 * @var array
	 */
	var $start			= array();

	/**
	 * Term duration
	 *
	 * @var array
	 */
	var $duration		= array();

	/**
	 * Term costs
	 *
	 * @var array
	 */
	var $cost			= array();

	/**
	 * Is it free?
	 *
	 * @var bool
	 */
	var $free			= false;

	/**
	 * Digestible form of term duration
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function renderDuration()
	{
		if ( isset( $this->duration['none'] ) ) {
			return '';
		} elseif ( isset( $this->duration['lifetime'] ) ) {
			return _AEC_CHECKOUT_DUR_LIFETIME;
		} else {
			switch ( $this->duration['unit'] ) {
				case 'D':
					$unit = 'day';
					break;
				case 'W':
					$unit = 'week';
					break;
				case 'M':
					$unit = 'month';
					break;
				case 'Y':
					$unit = 'year';
					break;
			}

			if ( $this->duration['period'] > 1 ) {
				$unit .= 's';
			}

			return $this->duration['period'] . ' ' . constant( strtoupper( '_aec_checkout_dur_' . $unit ) );
		}
	}

	/**
	 * Digestible form of term cost
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function renderCost()
	{
		if ( count( $this->cost ) <= 2 ) {
			return array( $this->cost[0] );
		} else {
			return $this->cost;
		}
	}

	/**
	 * Adding a cost item, either the root amount, or a discount.
	 * Will automatically compute the total.
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function addCost( $amount, $info=null, $tax=null )
	{
		if ( !empty( $this->cost ) ) {
			// Delete current total, if exists
			foreach( $this->cost as $cid => $cost ) {
				if ( $cost->type == 'total' ) {
					unset( $this->cost[$cid] );
				}
			}
		}

		// Switch this to discount if its negative
		if ( $amount < 0 ) {
			$type = 'discount';
		} else {
			if ( $tax ) {
				$type = 'tax';
			} else {
				$type = 'cost';
			}
		}

		$cost = new mammonCost();
		$cost->set( 'type', $type );

		if ( !empty( $info ) && is_array( $info ) ) {
			$content = array_merge( array( 'amount' => $amount ), $info );

			$cost->set( 'cost', $content );
		} else {
			$cost->set( 'cost', array( 'amount' => $amount ) );
		}

		$this->cost[] = $cost;

		// Compute value of total cost
		$total = 0;
		foreach ( $this->cost as $citem ) {
			$total += $citem->renderCost();
		}

		// Set total cost object
		$cost = new mammonCost();
		$cost->set( 'type', 'total' );
		$cost->set( 'cost', array( 'amount' => $total ) );

		if ( $cost->isFree() ) {
			$this->free = true;
		}

		$this->cost[] = $cost;
	}

	/**
	 * Reset all cost entries, create new root cost
	 * Will automatically compute the total.
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function setCost( $amount, $info=null )
	{
		$this->cost = array();

		$amount = AECToolbox::correctAmount( $amount );

		$cost = new mammonCost();
		$cost->set( 'type', 'cost' );

		if ( !empty( $info ) && is_array( $info ) ) {
			$content = array_merge( array( 'amount' => $amount ), $info );

			$cost->set( 'cost', $content );
		} else {
			$cost->set( 'cost', array( 'amount' => $amount ) );
		}

		$this->cost[] = $cost;

		// Compute value of total cost
		$total = 0;
		foreach ( $this->cost as $citem ) {
			$total += $citem->renderCost();
		}

		// Set total cost object
		$cost = new mammonCost();
		$cost->set( 'type', 'total' );
		$cost->set( 'cost', array( 'amount' => $total ) );

		if ( $cost->isFree() ) {
			$this->free = true;
		}

		$this->cost[] = $cost;
	}

	/**
	 * add Discount
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function discount( $amount, $percent=null, $info=null  )
	{
		// Only apply if its not already free
		if ( !$this->free ) {
			// discount amount
			if ( !empty( $amount ) ) {
				$am = 0 - $amount;
				$am = AECToolbox::correctAmount( $am );
				$this->addCost( $am, $info );
			}

			// discount percentage
			if ( !empty( $percent ) ) {
				$total = $this->renderTotal();

				$am = 0 - round( ( ( $total / 100 ) * $percent ), 2 );
				$am = AECToolbox::correctAmount( $am );
				$this->addCost( $am, $info );
			}
		}
	}

	/**
	 * Simple total return
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function renderTotal()
	{
		$k = array_pop( array_keys( $this->cost ) );
		return $this->cost[$k]->renderCost();
	}

}

/**
 * Cost Object, representing cost of one term
 *
 * @author	David Deutsch <skore@valanx.org>
 * @package		AEC Component
 * @subpackage	Library - Mammontini!
 * @since 1.0
 */
class mammonCost extends eucaObject
{
	/**
	 * Cost type
	 *
	 * Regular values: cost, discount, total
	 *
	 * @var string
	 */
	var $type			= null;

	/**
	 * Costs
	 *
	 * @var array
	 */
	var $cost			= array();

	/**
	 * Simple amount return
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function renderCost()
	{
		return AECToolbox::correctAmount( $this->cost['amount'] );
	}

	/**
	 * Returns true if this costs nothing
	 *
	 * @access	public
	 * @return	string
	 * @since	1.0
	 */
	function isFree()
	{
		if ( $this->renderCost() <= 0 ) {
			return true;
		} else {
			return false;
		}
	}
}

?>