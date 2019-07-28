<?php

/**
 * Adds Foo_Widget widget.
 */
class Youtubesubscribe_Widget extends WP_Widget {

	/**
	 * Register youtube subscribe widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'youtubesubscribe_widget', // Base ID
			esc_html__( 'Youtube Subscribe', 'youtube_domain' ), // Title of the widget displayed in adminpanel
			array( 'description' => esc_html__( 'Add Youtube Subscribe widget', 'youtube_domain' ), ) // Args description
		);
	}

	/**
	 * Front-end display of youtube subscribe widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // you can use anything to display before widget ex. <div>
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		
		/**widget content - the actual output of widget */
		echo '<div class="g-ytsubscribe" data-channel="'.$instance['channel'].'" data-layout="'.$instance['layout'].'" data-theme="'.$instance['theme'].'" data-count="'.$instance['count'].'"></div>';// we can use data-channel inst of data-channelid
		
		echo $args['after_widget']; // you can use anything to display after widget ex. </div>
	}

	/**
	 * Back-end youtube subscribe widget form.
	 * widget form that we can see in admin panel->appearance->widget 
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		/** Title of the widget in adminpanel */
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'YouTube Subscribe', 'youtube_domain' );

		/**channel name to be shown */
		$channel = ! empty( $instance['channel'] ) ? $instance['channel'] : esc_html__( 'UClGOgnvEeW01t1et9nhmEQA', 'youtube_domain' );
		// the code in esc_html__('here..'); is default channel name or id; that is my channel id Hiren Patel
		
		/**layout name to be shown (default/full)*/
		$layout = ! empty( $instance['layout'] ) ? $instance['layout'] : esc_html__( 'default', 'youtube_domain' );
		
		/**theme name to be shown (default/dark)*/
		$theme = ! empty( $instance['theme'] ) ? $instance['theme'] : esc_html__( 'default', 'youtube_domain' );
		
		/**subscription count to shown or make it hidden*/
		$count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( 'default', 'youtube_domain' );
		
		?>

		<!-- html for Title -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'youtube_domain' ); ?></label> 
			<input 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
			type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<!-- html for Channel -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>"><?php esc_attr_e( 'Channel:', 'youtube_domain' ); ?></label> 
			<input 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'channel' ) ); ?>" 
			type="text" value="<?php echo esc_attr( $channel ); ?>">
		</p>

		<!-- html for layout of subscribe button-->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_attr_e( 'Layout:', 'youtube_domain' ); ?></label> 
			<select 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" >
			<option value="default" <?php echo ($layout=='default') ? 'selected' : '' ?>>Default</option>
			<option value="full" <?php echo ($layout=='full') ? 'selected' : '' ?>>Full</option>
			
			</select>
		</p>

		<!-- html for theme of subscribe button-->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>"><?php esc_attr_e( 'Theme:', 'youtube_domain' ); ?></label> 
			<select 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'theme' ) ); ?>" >
			<option value="default" <?php echo ($theme=='default') ? 'selected' : '' ?>>Default</option>
			<option value="dark" <?php echo ($theme=='dark') ? 'selected' : '' ?>>Dark</option>
			
			</select>
		</p>

		<!-- html for subscription count of subscribe button-->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_attr_e( 'Subscribe Count:', 'youtube_domain' ); ?></label> 
			<select 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" >
			<option value="default" <?php echo ($count=='default') ? 'selected' : '' ?>>Default</option>
			<option value="hidden" <?php echo ($count=='hidden') ? 'selected' : '' ?>>Hidden</option>
			
			</select>
		</p>

		
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		/** title to be changed when changed in widget area backend */
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		
		/** channel to be changed when changed in widget area backend */
		$instance['channel'] = ( ! empty( $new_instance['channel'] ) ) ? sanitize_text_field( $new_instance['channel'] ) : '';

		/** layout to be changed when changed in widget area backend */
		$instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? sanitize_text_field( $new_instance['layout'] ) : '';

		/** theme to be changed when changed in widget area backend */
		$instance['theme'] = ( ! empty( $new_instance['theme'] ) ) ? sanitize_text_field( $new_instance['theme'] ) : '';
		
		/** Subscription count to be changed when changed in widget area backend */
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? sanitize_text_field( $new_instance['count'] ) : '';

		return $instance;
	}

} 
/** 
 * class Youtubesubscribe_Widget
 * next is to register this class to main widget file*/ 