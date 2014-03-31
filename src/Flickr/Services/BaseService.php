<?php
	namespace Flickr\Services;
	
	use Flickr\Exceptions\FlickrException;
	
	abstract class BaseService
	{
		private $endpoint = 'https://api.flickr.com/services/rest/?';
		
		public function get($params)
		{
			$params = implode('&',$params);
			echo $this->endpoint.$params."<br />";
			$contents = file_get_contents($this->endpoint.$params);
			$decode = json_decode($contents);
			if($decode->stat == "ok")
			{
				return $decode;
			}else
			{
				throw new FlickrException($decode->message, $decode->code);
			}
		}
		
		public function construct_photo_urls($photos)
		{
			if(count($photos) == 0)
				return array();
			for($i = 0; $i<count($photos); $i++)
			{
				$image = array();
				$image['small_square'] = "https://farm".$photos[$i]->farm.".staticflickr.com/".$photos[$i]->server."/".$photos[$i]->id."_".$photos[$i]->secret."_s.jpg";
				$image['large_square'] = "https://farm".$photos[$i]->farm.".staticflickr.com/".$photos[$i]->server."/".$photos[$i]->id."_".$photos[$i]->secret."_q.jpg";
				$image['thumbnail']    = "https://farm".$photos[$i]->farm.".staticflickr.com/".$photos[$i]->server."/".$photos[$i]->id."_".$photos[$i]->secret."_t.jpg";
				$image['small_240']    = "https://farm".$photos[$i]->farm.".staticflickr.com/".$photos[$i]->server."/".$photos[$i]->id."_".$photos[$i]->secret."_m.jpg";
				$image['small_320']    = "https://farm".$photos[$i]->farm.".staticflickr.com/".$photos[$i]->server."/".$photos[$i]->id."_".$photos[$i]->secret."_n.jpg";
				$image['medium_640']   = "https://farm".$photos[$i]->farm.".staticflickr.com/".$photos[$i]->server."/".$photos[$i]->id."_".$photos[$i]->secret."_z.jpg";
				$image['medium_800']   = "https://farm".$photos[$i]->farm.".staticflickr.com/".$photos[$i]->server."/".$photos[$i]->id."_".$photos[$i]->secret."_c.jpg";
				$image['large']        = "https://farm".$photos[$i]->farm.".staticflickr.com/".$photos[$i]->server."/".$photos[$i]->id."_".$photos[$i]->secret."_b.jpg";
				$image['original']     = $photos[$i]->url_o;
				$photo_urls[] = $image;
			}
			return $photo_urls;
		}
	}
?>