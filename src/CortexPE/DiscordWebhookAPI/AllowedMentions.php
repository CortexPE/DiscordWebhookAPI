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

use function count;
use function in_array;

class AllowedMentions implements \JsonSerializable
{
	/** @var bool */
	private $parseUsers = true, $parseRoles = true, $mentionEveryone = true, $suppressAll = false;

	/** @var array */
	private $roles = [];

	/** @var array */
	private $users = [];

	/**
	 * If following role is given into the messages content, every user of it will be mentioned
	 * @param string ...$roleID
	 */
	public function addRole(string ...$roleID): void {
		foreach ($roleID as $item) {
			if (in_array($item, $this->roles, true)) {
				continue;
			}

			$this->roles[] = $item;
		}
		$this->parseRoles = false;
	}

	/**
	 * If following user is given into the messages content, the user will be mentioned
	 * @param string ...$userID
	 */
	public function addUser(string ...$userID): void {
		foreach ($userID as $item) {
			if (in_array($item, $this->users, true)) {
				continue;
			}

			$this->users[] = $item;
		}

		$this->parseUsers = false;
	}

	/**
	 * If the message content has whether everyone or here and $mention is set to false, the users won't be mentioned
	 * @param bool $mention
	 */
	public function mentionEveryone(bool $mention): void {
		$this->mentionEveryone = $mention;
	}

	/**
	 * If this function is called no mention will be getting showed for anyone
	 */
	public function suppressAll(): void {
		$this->suppressAll = true;
	}

	public function jsonSerialize(): array
	{
		if ($this->suppressAll) {
			return [
				"parse" => []
			];
		}

		$data = ["parse" => []];
		if ($this->mentionEveryone) {
			$data["parse"][] = "everyone";
		}

		if (count($this->users) !== 0) {
			$data["users"] = $this->users;
		} else if ($this->parseUsers) {
			$data["parse"][] = "users";
		}

		if (count($this->roles) !== 0) {
			$data["roles"] = $this->roles;
		} else if ($this->parseRoles) {
			$data["parse"][] = "roles";
		}

		return $data;
	}
}