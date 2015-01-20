<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 * 
 * Helps build UI elements in the application
 */
class Elements extends Component {

  // This is the basic structure of the top navbar
  private $headerMenu = array(
    'navbar-right' => array(

      // Numbers are being used as an index of the order. For use with unset
      '0' => array(
        'caption'     => 'Home',
        'controller'  => 'index',
        'action'      => 'index'
      ),
      '1' => array(
        'caption'     => 'About',
        'controller'  => 'about',
        'action'      => 'index'
      ),
      '2' => array(
        'caption'     => 'Rules',
        'controller'  => 'rules',
        'action'      => 'index'
      ),
      '3' => array(
        'caption'     => 'Forums',
        'controller'  => 'forums',
        'action'      => 'index'
      ),
      '4' => array(
        'caption'     => 'Register',
        'controller'  => 'session',
        'action'      => 'register'
      ),
      '5' => array(
        'caption'     => 'Login',
        'controller'  => 'session',
        'action'      => 'login'
      ),
      '6' => array(
        'caption'     => 'Admin',
        'controller'  => 'admin',
        'action'      => 'index'
      ),
      '7' => array(
        'caption'     => 'Mod Tools',
        'controller'  => 'modtools',
        'action'      => 'index'
      ),
    ),
  );


	public function getHeaderMenu() {
    $auth = $this->session->get('auth');

    // Removes Login and Register links from navbar and adds in links depending
    // on role

    // Uncomment this if in production. See above for what to comment out if in production
    if($auth){
      unset($this->headerMenu['navbar-right']['4']);
      unset($this->headerMenu['navbar-right']['5']);

      // Mod Tools link is added for mod users
      if($auth['role'] == 3){
        $this->headerMenu['navbar-right']['4'] = array(
          'caption'     => 'Mod Tools',
          'controller'  => 'management',
          'action'      => 'index'
        );
      }

      // Admin link added for admin users
      if($auth['role'] == 6){
        $this->headerMenu['navbar-right']['4'] = array(
          'caption'     => 'Admin',
          'controller'  => 'admin',
          'action'      => 'index'
        );
      }

      $this->headerMenu['navbar-right']['5'] = array(
        'caption'       => 'Hello ' . $auth['firstName'],
        'dropdown'      => array(

          '0' => array(
            'caption'     => 'My Profile',
            'controller'  => 'profile',
            'action'      => 'index'
          ),
          '1' => array(
            'caption'     => 'Logout',
            'controller'  => 'session',
            'action'      => 'logout'
          )
        )
      );

    }

    // Buillds top nav bar using $headerMenu
    foreach($this->headerMenu as $position => $menu) {

      // Start by building ul with position data
      echo '<ul class="nav navbar-nav ' , $position, '">';

      // Iterate through each element
      foreach($menu as $order => $option){

        // If link is not a dropdown menu
        if(!array_key_exists("dropdown", $option)){
          $this->makeLinkForHeaderMenu($auth, $option);

        } else { // If it is a dropdown menu
          echo '<li class="dropdown">';
          echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $option['caption'] . ' <span class="caret"></span></a>';
          echo '<ul class="dropdown-menu" role="menu">';
          foreach($option['dropdown'] as $position_drop => $option2){

            $this->makeLinkForHeaderMenu($auth, $option2);
          }
          echo '</ul>';
        }

      }

      echo '</ul>';
    }



		
	}

  // Sets active class to to li whose controller and action names are match
  // with current controller and action names
  private function makeLinkForHeaderMenu($auth, $item){
    $controllerName = $this->view->getControllerName();
    $actionName = $this->view->getActionName();

    if($controllerName == $item['controller'] && $actionName == $item['action'] ) {
      echo '<li class="active">';
    } else {
      echo '<li>';
    }

    // Build Link
    echo $this->tag->linkTo($item['controller'] . '/' . $item['action'], $item['caption']);
    echo '</li>';
  }
	
	public function getTabs() {
		
	}
	
	
}


?>