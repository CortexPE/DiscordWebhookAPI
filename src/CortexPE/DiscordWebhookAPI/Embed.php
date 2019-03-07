<?php

/**
 *
 *  _____      __    _   ___ ___
 * |   \ \    / /__ /_\ | _ \_ _|
 * | |) \ \/\/ /___/ _ \|  _/| |
 * |___/ \_/\_/   /_/ \_\_| |___|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * Written by @CortexPE <https://CortexPE.xyz>
 * Intended for use on SynicadeNetwork <https://synicade.com>
 */

declare(strict_types = 1);

namespace CortexPE\DiscordWebhookAPI;


class Embed {
	/** @var array */
	protected $data = [];

	public function asArray(): array{
		// Why doesn't PHP have a `__toArray()` magic method??? This would've been better.
		return $this->data;
	}

	public function setAuthor(string $name, string $url = null, string $iconURL = null):void{
		if(!isset($this->data["author"])){
			$this->data["author"] = [];
		}
		$this->data["author"]["name"] = $name;
		if($url !== null){
			$this->data["author"]["url"] = $url;
		}
		if($iconURL !== null){
			$this->data["author"]["icon_url"] = $iconURL;
		}
	}

	public function setTitle(string $title):void{
		$this->data["title"] = $title;
	}

	public function setDescription(string $description):void{
		$this->data["description"] = $description;
	}

	public function setColor(int $color):void{
		$this->data["color"] = $color;
	}

	public function addField(string $name, string $value, bool $inline = false):void{
		if(!isset($this->data["fields"])){
			$this->data["fields"] = [];
		}
		$this->data["fields"][] = [
			"name" => $name,
			"value" => $value,
			"inline" => $inline,
		];
	}

	public function setThumbnail(string $url):void{
		if(!isset($this->data["thumbnail"])){
			$this->data["thumbnail"] = [];
		}
		$this->data["thumbnail"]["url"] = $url;
	}

	public function setImage(string $url):void{
		if(!isset($this->data["image"])){
			$this->data["image"] = [];
		}
		$this->data["image"]["url"] = $url;
	}

	public function setFooter(string $text, string $iconURL = null):void{
		if(!isset($this->data["footer"])){
			$this->data["footer"] = [];
		}
		$this->data["footer"]["text"] = $text;
		if($iconURL !== null){
			$this->data["footer"]["icon_url"] = $iconURL;
		}
	}

	public function setTimestamp(\DateTime $timestamp):void{
		$timestamp->setTimezone(new \DateTimeZone("UTC"));
		$this->data["timestamp"] = $timestamp->format("Y-m-d\TH:i:s.v\Z");
	}
}
