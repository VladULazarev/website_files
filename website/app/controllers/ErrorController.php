<?php

namespace App\Controllers;

use Core\Controller;

class ErrorController extends Controller
{
		/**
		 * If a webpage or data from DB were not found
		 */
		public static function notFound()
		{
				echo "<script>location='/404.php';</script>";
		}
}
