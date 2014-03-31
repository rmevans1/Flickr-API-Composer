<?php
	namespace Flickr\Services;
	
	class PhotosetsService extends BaseService
	{
		private $api_key;
		
		public function __construct($api_key)
		{
			$this->api_key = $api_key;
		}
		
		/**
		 * Get information for the specified photoset id
		 * @param string $photoset_id- The ID of the photoset to fetch information for.
		 * @return object with photoset information
		 */
		public function getInfo($photoset_id)
		{
			$params = array(
				'method=flickr.photosets.getInfo',
				'api_key='.$this->api_key,
				'photoset_id='.$photoset_id,
				'format=json',
				'nojsoncallback=1'
			);
			
			$json = parent::get($params);
			
			return $json->photoset;
		}
		
		/**
		 * Get all photoset ids for the specified user id
		 * @param string $user_id- The NSID of the user to get a photoset list for.
		 * @return array of photoset ids
		 */
		public function getList($user_id)
		{
			$photosets = array();
			$params = array(
				'method=flickr.photosets.getList',
				'api_key='.$this->api_key,
				'user_id='.$user_id,
				'format=json',
				'nojsoncallback=1'
			);
				
			$json = parent::get($params);
			$photoset = $json->photosets->photoset;
			for($i = 0; $i<count($photoset); $i++)
			{
				$photosets[]=$photoset[$i]->id;
			}
			return $photosets;
		}
		
		/**
		 * Get photos for the specified photoset id
		 * @param string $photoset_id- The ID of the photoset to fetch information for.
		 * @return array with photolinks
		 */
		public function getPhotos($photoset_id)
		{
			$photo_urls = array();
			$params = array(
				'method=flickr.photosets.getPhotos',
				'api_key='.$this->api_key,
				'photoset_id='.$photoset_id,
				'format=json',
				'nojsoncallback=1',
				'extras=url_o'
			);
				
			$json = parent::get($params);
			$photos = $json->photoset->photo;
			$photo_urls = parent::construct_photo_urls($photos);
			return $photo_urls;
		}
	}
?>