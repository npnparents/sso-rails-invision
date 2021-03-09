<?php
/**
 * @brief   NPN API
 * @author		<a href='https://www.npnparents.org'>Neighborhood Parents Network</a>
 * @copyright	(c) 2019 
 * @package		IPS Community Suite
 * @since		23 Nov 2016
 * @version 2.0.0
 */

namespace IPS\npn\api;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
  header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
  exit;
}

/**
 * @brief NPN Members API
 */
class _members extends \IPS\Api\Controller
{
	/**
	*	POST /npn/members
	* Create a member
	*
	* @apiparam	string	name		Display Name
	* @apiparam	string	email		Email address
	* @apiparam	string	password	Password
	* @apiparam	int		group		Group ID number
	* @apiparam	int		joined_at		Date joined in Unix Timestamp (if not present using current date)
	* @throws		NPN_API_MEMBERS_ERROR/4	USERNAME_EXISTS			The username provided is already in use
	* @throws		NPN_API_MEMBERS_ERROR/5	EMAIL_EXISTS			The email address provided is already in use
	* @throws		NPN_API_MEMBERS_ERROR/6	INVALID_GROUP			The group ID provided is not valid
	* @throws		NPN_API_MEMBERS_ERROR/8	NO_USERNAME_OR_EMAIL	No Username or Email Address was provided for the account
	* @throws		NPN_API_MEMBERS_ERROR/9	NO_PASSWORD				No password was provided for the account
	* @return
	*/
	public function POSTindex()
	{
		/* One of these must be provided to ensure user can log in. */
		if ( !isset( \IPS\Request::i()->name ) AND !isset( \IPS\Request::i()->email ) )
		{
			throw new \IPS\Api\Exception( 'NO_USERNAME_OR_EMAIL', 'NPN_API_MEMBERS_ERROR/8', 403 );
		}

		/* This is required as there is no other way to allow the account to be authenticated when it is created via the API */
		if ( !isset( \IPS\Request::i()->password ) )
		{
			throw new \IPS\Api\Exception( 'NO_PASSWORD', 'NPN_API_MEMBERS_ERROR/9', 403 );
		}

		$member = new \IPS\Member;
		$member->member_group_id = \IPS\Settings::i()->member_group;
		$member->members_bitoptions['created_externally'] = TRUE;
		
		$member = $this->_createOrUpdate( $member );

		return new \IPS\Api\Response( 201, array( "success" => true, "member_id" => $member->member_id ) );

		// return new \IPS\Api\Response( 201, $member->apiOutput( $this->member ) );
	}

	/**
	* POST /npn/members/{id}
	* Edit a member
	*
	* @apiparam	string	name		Username
	* @apiparam	string	email		Email address
	* @apiparam	string	password	Password
	* @apiparam	int		group		Group ID number
	* @param 		int		$id			ID Number
	* @throws		NPN_API_MEMBERS_ERROR/7	INVALID_ID	The member ID does not exist
	* @throws		NPN_API_MEMBERS_ERROR/4	USERNAME_EXISTS	The username provided is already in use
	* @throws		NPN_API_MEMBERS_ERROR/5	EMAIL_EXISTS	The email address provided is already in use
	* @return
	*/
	public function POSTitem( $id )
	{
		try
		{
			$member = \IPS\Member::load( $id );
			if ( !$member->member_id )
			{
				throw new \OutOfRangeException;
			}

			$member = $this->_createOrUpdate( $member );

			return new \IPS\Api\Response( 200, array( "success" => true ) );
		}
		catch ( \OutOfRangeException $e )
		{
			throw new \IPS\Api\Exception( 'INVALID_ID', 'NPN_API_MEMBERS_ERROR/7', 404 );
		}
	}


  /**
  * DELETE /npn/members/{id}
  * Deletes a member
  *
  * @apiparam	int		$id			ID Number
  * @throws		NPN_API_MEMBERS_ERROR/1	INVALID_ID	The member ID does not exist
  * @return
  */
  public function DELETEitem( $id )
  {
    try
    {
      $member = \IPS\Member::load( $id );
      if ( !$member->member_id )
      {
        throw new \OutOfRangeException;
      }

      $member->delete();

      return new \IPS\Api\Response( 200, array( "success" => true ) );
    }
    catch ( \OutOfRangeException $e )
    {
      throw new \IPS\Api\Exception( 'INVALID_ID', 'NPN_API_MEMBERS_ERROR/1', 404 );
    }
  }

  /**
	 * Create or update member
	 *
	 * @param	\IPS\Member	$member	The member
	 * @apiparam	int		group		Group ID number
	 * @throws		NPN_API_MEMBERS_ERROR/4	USERNAME_EXISTS	The username provided is already in use
	 * @throws		NPN_API_MEMBERS_ERROR/5	EMAIL_EXISTS	The email address provided is already in use
	 * @throws		NPN_API_MEMBERS_ERROR/6	INVALID_GROUP	The group ID provided is not valid
	 * @return		\IPS\Member
	 */
	protected function _createOrUpdate( $member )
	{
		if ( isset( \IPS\Request::i()->name ) and \IPS\Request::i()->name != $member->name )
		{
			$existingUsername = \IPS\Member::load( \IPS\Request::i()->name, 'name' );
			if ( !$existingUsername->member_id )
			{
				$member->logHistory( 'core', 'display_name', array( 'old' => $member->name, 'new' => \IPS\Request::i()->name, 'by' => 'api' ) );
				$member->name = \IPS\Request::i()->name;
			}
			else
			{
				throw new \IPS\Api\Exception( 'USERNAME_EXISTS', 'NPN_API_MEMBERS_ERROR/4', 403 );
			}
		}

		if ( isset( \IPS\Request::i()->email ) and \IPS\Request::i()->email != $member->email )
		{
			$existingEmail = \IPS\Member::load( \IPS\Request::i()->email, 'email' );
			if ( !$existingEmail->member_id )
			{
				$member->logHistory( 'core', 'email_change', array( 'old' => $member->name, 'new' => \IPS\Request::i()->name, 'by' => 'api' ) );
				$member->email = \IPS\Request::i()->email;
				// $member->invalidateSessionsAndLogins();
			}
			else
			{
				throw new \IPS\Api\Exception( 'EMAIL_EXISTS', 'NPN_API_MEMBERS_ERROR/5', 403 );
			}
		}

		if ( isset( \IPS\Request::i()->group ) )
		{
			try
			{
				$group = \IPS\Member\Group::load( \IPS\Request::i()->group );
				$member->member_group_id = $group->g_id;
			}
			catch ( \OutOfRangeException $e )
			{
				throw new \IPS\Api\Exception( 'INVALID_GROUP', 'NPN_API_MEMBERS_ERROR/6', 403 );
			}
		}

		if ( isset( \IPS\Request::i()->joined_at ) )
		{
			if ( \IPS\Request::i()->joined_at == 0 )
			{
				$member->joined = time();
			}
			else
			{
				$member->joined = \IPS\Request::i()->joined_at;
			}

		}

		// if ( isset( \IPS\Request::i()->password ) )
		// {
		// 	foreach ( \IPS\Login::handlers( TRUE ) as $handler )
		// 	{
		// 		try
		// 		{
		// 			$handler->changePassword( $member, \IPS\Request::i()->password );
		// 		}
		// 		catch( \BadMethodCallException $e ){}
		// 	}
		// }
		// else
		// {
		// 	$member->save();
		// }
		if ( isset( \IPS\Request::i()->password ) )
		{
			/* Setting the password for the just created member shouldn't be logged to the member history and shouldn't fire the onPassChange Sync call */
			$logPasswordChange = TRUE;
			if ( $member->member_id )
			{
				$logPasswordChange = FALSE;
			}
			$member->setLocalPassword( \IPS\Request::i()->password );
			$member->save();

			if ( $logPasswordChange )
			{
				$member->memberSync( 'onPassChange', array( \IPS\Request::i()->password ) );
				$member->logHistory( 'core', 'password_change', 'api' );
			}

			// $member->invalidateSessionsAndLogins();
		}
		else
		{
			$member->save();
		}

		return $member;
	}
}
