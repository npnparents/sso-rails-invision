<?php
/**
 * @brief   SSO-RAILS-INVISION Hello API
 * @author    <a href='https://www.npnparents.org'>Neighborhood Parents Network</a>
 * @copyright (c) 2019
 * @package   IPS Community Suite
 * @since   23 Nov 2016
 * @version
 */

namespace IPS\npn\api;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
  header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
  exit;
}

/**
 * @brief Hello API
 */
class _hello extends \IPS\Api\Controller
{
  /**
   * GET /npn/hello
   * Verifies that a newly set up API client can access this IPBoard API server
   *
   * @return
   */
  public function GETindex()
  {
    return new \IPS\Api\Response( 200, array( 'response' => 'success' ) );
  }
}
