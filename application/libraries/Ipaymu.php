<?php

(!defined( 'BASEPATH' )) ? exit( 'No direct script access allowed' ) : '';

/*
 * This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * 
 * Author   : Agus Suroyo
 * Email    : jony.extenz@gmail.com
 * Twitter  : @jonyextenz
 * Website  : http://agussuroyo.com/
 */

class IPaymu{

    /** Requirements Params */
    var $CI;
    var $url_cek_saldo = 'https://my.ipaymu.com/api/CekSaldo.php';
    var $url_cek_transaksi = 'https://my.ipaymu.com/api/CekTransaksi.php';
    var $url_cek_status = 'https://my.ipaymu.com/api/CekStatus.php';
    var $key = FALSE;
    var $available_format = array( 'json', 'xml' );
    var $format = '';
    var $action = 'payment';
    var $product = '';
    var $price = '';
    var $quantity = '';
    var $comments = '';
    var $ureturn = '';
    var $unotify = '';
    var $ucancel = '';
    var $uniqid = '';

    /** Optional Param */
    var $invoice_number = '';
    var $paypal_email = '';
    var $paypal_price = '';
    var $user = '';

    /** Payment URL */
    // var $payment_url = 'https://my.ipaymu.com/payment.htm';

    /** HTTP Query Builder */
    var $http_query_builder;
    var $count_http_query_builder;
    var $curl = '';
    var $query;

    /** uNotify Params iPaymu */
    var $unotify_query = '';
    var $status = '';
    var $trx_id = '';
    var $sid = '';
    var $merchant = '';
    var $buyer = '';
    var $total = '';
    var $no_rekening_deposit = '';
    var $referer = '';

    /** uNotify Params PayPal */
    var $paypal_trx_id = '';
    var $paypal_invoice_number = '';
    var $paypal_currency = '';
    var $paypal_trx_total = '';
    var $paypal_trx_fee = '';
    var $paypal_buyer_email = '';
    var $paypal_buyer_status = '';
    var $paypal_buyer_name = '';

    public function __construct( $config = array() )
    {

        if ( !$this->is_enabled() ) {
            log_message( 'error', 'cURL Class - PHP was not built with cURL enabled. Rebuild PHP with --with-curl to use cURL.' );
        }

        $this->CI = & get_instance();

        $this->CI->load->config( 'ipaymu' );
        $this->key = ($this->CI->config->item( 'ipaymu_key' ) !== '') ? $this->CI->config->item( 'ipaymu_key' ) : FALSE;
        $this->format = $this->available_format[0];

        if ( count( $config ) > 0 ) {
            $this->initialize( $config );
        }

        log_message( 'debug', "iPaymu Class Initialized" );
    }

    function initialize( $config = array() )
    {
        $this->query = array();
        $this->query['key'] = $this->key;
        $this->query['format'] = $this->format;
        $this->query['action'] = $this->action;
        foreach ( $config as $key => $val ) {
            if ( isset( $this->$key ) ) {
                $this->$key = $val;
                $this->query[$key] = $val;
            }
        }
    }

    public function is_enabled()
    {
        return function_exists( 'curl_init' );
    }

    public function valid_format( $format = '' )
    {
        if ( $format === '' ) {
            return FALSE;
        }

        return in_array( strtolower( $format ), $this->available_format );
    }

    private function curl( $url = '', $query = array(), $transfer = TRUE, $ssl_verify = FALSE )
    {
        if ( $url === '' ) {
            return FALSE;
        }
        $this->curl = curl_init();
        $this->http_query_builder = http_build_query( $query );
        $this->count_http_query_builder = count( $query );
        curl_setopt( $this->curl, CURLOPT_URL, $url );
        curl_setopt( $this->curl, CURLOPT_POST, $this->count_http_query_builder );
        curl_setopt( $this->curl, CURLOPT_POSTFIELDS, $this->http_query_builder );
        curl_setopt( $this->curl, CURLOPT_RETURNTRANSFER, $transfer );
        curl_setopt( $this->curl, CURLOPT_SSL_VERIFYPEER, $ssl_verify );
        $request = curl_exec( $this->curl );
        $return = ($request === FALSE) ? curl_error( $this->curl ) : $request;
        curl_close( $this->curl );
        return $return;
    }

    public function response()
    {
        if ( $this->key === FALSE || empty( $this->query ) || config('ipaymu_url') === '' ) {
            return FALSE;
        }

        return $this->curl( config('ipaymu_url'), $this->query );
    }

    public function cektransaksi( $id = '', $format = '' )
    {

        if ( $format !== '' ) {
            $this->format = $format;
        }

        if ( $this->valid_format( $this->format ) && $this->key !== FALSE && $id !== '' ) {
            $this->format = $format;
            $params['key'] = $this->key;
            $params['id'] = $id;
            $params['format'] = $this->format;

            return $this->curl( $this->url_cek_transaksi, $params );
        }

        return FALSE;
    }

 

    public function ceksaldo( $format = '' )
    {
        if ( $format !== '' ) {
            $this->format = $format;
        }

        if ( $this->valid_format( $this->format ) && $this->key !== FALSE ) {
            $params['key'] = $this->key;
            $params['format'] = $this->format;

            return $this->curl( $this->url_cek_saldo, $params );
        }

        return FALSE;
    }

    public function cekstatus( $user = '', $format = '' )
    {

        if ( $format !== '' ) {
            $this->format = $format;
        }

        if ( $this->valid_format( $this->format ) && $this->key !== FALSE && $user !== '' ) {
            $this->format = $format;
            $params['key'] = $this->key;
            $params['user'] = $user;
            $params['format'] = $this->format;

            return $this->curl( $this->url_cek_status, $params );
        }

        return FALSE;
    }

    public function unotify( $params = array() )
    {
        if ( !is_array( $params ) || empty( $params ) ) {
            return FALSE;
        }
        foreach ( $params as $key => $val ) {
            if ( isset( $this->$key ) ) {
                $this->$key = $val;
                $this->unotify_query[$key] = $val;
            }
        }
        return $this->unotify_query;
    }

    public function callback( $method = '', $params = array() )
    {
        if ( $method !== '' ) {
            $return = '';
            switch ( strtolower( $method ) ) {
                case 'ureturn':
                    $return = $params;
                    break;
                case 'unotify':
                    $return = $this->unotify( $params );
                    break;
                case 'ucancel':
                    $return = $params;
                    break;
                default:
                    $return = FALSE;
                    break;
            }
            return $return;
        } else {
            return FALSE;
        }
    }

}
