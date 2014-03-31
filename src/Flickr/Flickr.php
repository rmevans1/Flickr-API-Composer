<?php
	namespace Flickr;
	
	use Flickr\Auth\FlickrOAuth;
	use Flickr\Services\PhotosetsService;
	use Flickr\Services\PeopleService;
	use Flickr\Exceptions\FlickrException;
	use Flickr\Exceptions\FlickrOAuthException;
	
	class Flickr
	{
		private $api_key;
		private $api_secret;
		
		protected $flickr_auth;
		protected $photosets_service;
		protected $people_service;
		
		public function __construct($api_key, $api_secret)
		{
			$this->api_key = $api_key;
			$this->api_secret = $api_secret;
			
			$this->flickr_auth = new FlickrOAuth($api_key, $api_secret);
			
			$this->photosets_service = new PhotosetsService($api_key);
			$this->people_service = new PeopleService($api_key);
		}
		
		/**
		 * Get the user's NSID, given their email address
		 * @param string $email- The email address of the user to find
		 * @return The user's NSID
		 */
		public function peopleFindByEmail($email)
		{
			return $this->people_service->findByEmail($email);
		}
		
		/**
		 * Get the user's NSID, given their user name
		 * @param string $username- The user name of the user to find
		 * @return The user's NSID
		 */
		public function peopleFindByUsername($user_name)
		{
			return $this->people_service->findByUsername($user_name);
		}
		
		/**
		 * Get information about a user
		 * @param string $user_id- The NSID of the user to fetch information about
		 * @return The user's information
		 */
		public function peopleGetInfo($user_id)
		{
			return $this->people_service->getInfo($user_id);
		}
		
		/**
		 * Get photos from the given user's photo stream
		 * @param string $user_id- The NSID of the user to return photos for
		 * @return The user's photos
		 */
		public function peopleGetPhotos($user_id)
		{
			return $this->people_service->getPhotos($user_id);
		}
		
		/**
		 * Get photos of a particular user
		 * @param string $user_id- The NSID of the user to return photos of.
		 * @return The photos of the user
		 */
		public function peopleGetPhotosOf($user_id)
		{
			return $this->people_service->getPhotosOf($user_id);
		}
		
		/**
		 * Get the public groups the user is a member of
		 * @param string $user_id- The NSID of the user to fetch groups for.
		 * @return The list of public groups the user is a member of.
		 */
		public function peopleGetPublicGroups($user_id)
		{
			return $this->people_service->getPublicGroups($user_id);
		}
		
		/**
		 * Get public photos of a particular user
		 * @param string $user_id- The NSID of the user to return photos for.
		 * @return The public photos for the user
		 */
		public function peopleGetPublicPhotos($user_id)
		{
			return $this->people_service->getPublicPhotos($user_id);
		}
		
		public function setAuth()
		{
			$this->flickr_auth->setPath("https://www.flickr.com/services/oauth/request_token");
			$this->flickr_auth->setParameters("oauth_callback=".urlencode("http://www.robertevansmb.com/flickr/test"));
			//$this->flickr_auth->setAction("GET");
			//$this->flickr_auth->setSignatureMethod("HMAC-SHA1");
			$this->flickr_auth->getToken();
		}
		
		/**
		 * Get information for the specified photoset id
		 * @param string $photoset_id- The ID of the photoset to fetch information for.
		 * @return object with photoset information
		 */
		public function getPhotosetInfo($photoset_id)
		{
			return $this->photosets_service->getInfo($photoset_id);
		}
		
		/**
		 * Get all photoset ids for the specified user id
		 * @param string $user_id- The NSID of the user to get a photoset list for.
		 * @return array of photoset ids
		 */
		public function getPhotosetsList($user_id)
		{
			return $this->photosets_service->getList($user_id);
		}
		
		/**
		 * Get photos for the specified photoset id
		 * @param string $photoset_id- The ID of the photoset to fetch information for.
		 * @return array with photolinks
		 */
		public function getPhotosetPhotos($photoset_id)
		{
			return $this->photosets_service->getPhotos($photoset_id);
		}
	}
?>