<?php
	namespace Flickr\Services;
	
	class PeopleService extends BaseService
	{
		private $api_key;
		
		public function __construct($api_key)
		{
			$this->api_key = $api_key;
		}
		
		/**
		 * Get the user's NSID, given their email address
		 * @param string $email- The email address of the user to find
		 * @return The user's NSID
		 */
		public function findByEmail($email)
		{
			$params = array(
				'method=flickr.people.findByEmail',
				'api_key='.$this->api_key,
				'find_email='.$email,
				'format=json',
				'nojsoncallback=1'
			);
			
			$json = parent::get($params);
			
			return $json->user->nsid;
		}
		
		/**
		 * Get the user's NSID, given their user name
		 * @param string $username- The user name of the user to find
		 * @return The user's NSID
		 */
		public function findByUsername($username)
		{
			$params = array(
				'method=flickr.people.findByUsername',
				'api_key='.$this->api_key,
				'username='.$username,
				'format=json',
				'nojsoncallback=1'
			);
			
			$json = parent::get($params);
			
			return $json->user->nsid;
		}
		
		/**
		 * Get information about a user
		 * @param string $user_id- The NSID of the user to fetch information about
		 * @return The user's information
		 */
		public function getInfo($user_id)
		{
			$params = array(
				'method=flickr.people.getInfo',
				'api_key='.$this->api_key,
				'user_id='.$user_id,
				'format=json',
				'nojsoncallback=1'
			);
			
			$json = parent::get($params);
			
			return $json;
		}
		
		/**
		 * Get photos from the given user's photo stream
		 * @param string $user_id- The NSID of the user to return photos for
		 * @return The user's photos
		 */
		public function getPhotos($user_id)
		{
			$params = array(
				'method=flickr.people.getPhotos',
				'api_key='.$this->api_key,
				'user_id='.$user_id,
				'format=json',
				'nojsoncallback=1',
				'extras=url_o'
			);
			
			$json = parent::get($params);
			
			return parent::construct_photo_urls($json->photos->photo);
		}
		
		/**
		 * Get photos of a particular user
		 * @param string $user_id- The NSID of the user to return photos of.
		 * @return The photos of the user
		 */
		public function getPhotosOf($user_id)
		{
			$params = array(
				'method=flickr.people.getPhotosOf',
				'api_key='.$this->api_key,
				'user_id='.$user_id,
				'format=json',
				'nojsoncallback=1',
				'extras=url_o'
			);
			
			$json = parent::get($params);
			
			return parent::construct_photo_urls($json->photos->photo);
		}
		
		/**
		 * Get the public groups the user is a member of
		 * @param string $user_id- The NSID of the user to fetch groups for.
		 * @return The list of public groups the user is a member of.
		 */
		public function getPublicGroups($user_id)
		{
			$params = array(
				'method=flickr.people.getPublicGroups',
				'api_key='.$this->api_key,
				'user_id='.$user_id,
				'format=json',
				'nojsoncallback=1'
			);
			
			$json = parent::get($params);
			
			return $json;
		}
		
		/**
		 * Get public photos of a particular user
		 * @param string $user_id- The NSID of the user to return photos for.
		 * @return The public photos for the user
		 */
		public function getPublicPhotos($user_id)
		{
			$params = array(
				'method=flickr.people.getPublicPhotos',
				'api_key='.$this->api_key,
				'user_id='.$user_id,
				'format=json',
				'nojsoncallback=1',
				'extras=url_o'
			);
			
			$json = parent::get($params);
			
			return parent::construct_photo_urls($json->photos->photo);
		}
	}
?>