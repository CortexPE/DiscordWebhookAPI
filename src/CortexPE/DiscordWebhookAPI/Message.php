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


class Message implements \JsonSerializable {
	/** @var array */
	protected $data = [];

	public function setContent(string $content): void{
		$this->data["content"] = $content;
	}

	public function getContent(): ?string{
		return $this->data["content"];
	}

	public function getUsername(): ?string{
		return $this->data["username"];
	}

	public function setUsername(string $username): void{
		$this->data["username"] = $username;
	}

	public function getAvatarURL(): ?string{
		return $this->data["avatar_url"];
	}

	public function setAvatarURL(string $avatarURL): void{
		$this->data["avatar_url"] = $avatarURL;
	}

	public function addEmbed(Embed $embed):void{
		if(!empty(($arr = $embed->asArray()))){
			$this->data["embeds"][] = $arr;
		}
	}

	public function setTextToSpeech(bool $ttsEnabled):void{
		$this->data["tts"] = $ttsEnabled;
	}

	public function jsonSerialize(): mixed{
		return $this->data;
	}
}
