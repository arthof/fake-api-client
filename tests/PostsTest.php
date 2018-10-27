<?php

use FakeApiClient\Client;

class PostsTest extends \PHPUnit\Framework\TestCase
{
	public function testFetchPost()
	{
        $postId = 34;
        $Client = new Client();
        $post = $Client->Posts->Fetch($postId);
		$this->assertTrue($post->id==$postId);
    }
    
    public function testFetchAllPosts()
	{
        $Client = new Client();
        $Posts = $Client->Posts->FetchAll();
        $samplePostId = 46;
        $this->assertTrue(is_array($Posts) && count($Posts));
        $this->assertTrue($Posts[$samplePostId-1]->id==$samplePostId);
    }

    public function testFetchPostsByUser()
	{
        $userId = 2;
        $Client = new Client();
        $Posts = $Client->Posts->FetchByUser($userId);
        $this->assertTrue(is_array($Posts) && count($Posts));
        $this->assertTrue($Posts[0]->userId==$userId);
    }

    public function testFetchPostComments()
	{
        $postId = 4;
        $Client = new Client();
        $Comments = $Client->Posts->FetchComments($postId);
        $this->assertTrue(is_array($Comments) && count($Comments));        
        $this->assertTrue($Comments[0]->postId==$postId);
    }

    public function testCreatePost()
	{
        $createPost = [
            'title' => 'Lorem ipsum',
            'body' => 'Sample text',
            'userId' => 3,
        ];
        $Client = new Client();
        $post = $Client->Posts->Create($createPost);
		$this->assertTrue(is_object($post) && property_exists($post, 'id'));
    }

    public function testReplacePost()
	{
        $postId = 74;
        $replacePost = [
            'id' => 74,
            'title' => 'Lorem ipsum',
            'body' => 'Sample text',
            'userId' => 3,
        ];
        $Client = new Client();
        $post = $Client->Posts->Replace($postId, $replacePost);
		$this->assertTrue(is_object($post) && $post->title==$replacePost['title']);
    }

    public function testDeletePost()
	{
        $postId = 34;
        $Client = new Client();
        $result = $Client->Posts->Delete(34);
		$this->assertTrue(is_object($result));
    }


    public function testUpdatePost()
	{
        $postId = 74;
        $updatePost = [
            'title' => 'Winnie the pooh',
        ];
        $Client = new Client();
        $post = $Client->Posts->Update($postId, $updatePost);
		$this->assertTrue(is_object($post) && $post->title==$updatePost['title']);
    }

}