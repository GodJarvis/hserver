<?php

declare(strict_types=1);
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2025/8/14
 * Time: 20:11
 */

namespace App\Controller\Admin;

use App\Event\MemberFoundEvent;
use App\Repository\MySQL\MemberRepository;
use App\Utils\Logger\Log;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Psr\EventDispatcher\EventDispatcherInterface;

#[AutoController]
class TestHoloController extends BaseController
{
    #[Inject]
    public MemberRepository $memberRepository;

    #[Inject]
    public EventDispatcherInterface $eventDispatcher;

    public function get()
    {
        $id = $this->request->post('id', 1);
        $member = $this->memberRepository->getMemberById($id);
        Log::get()->info('get message success:', ['message' => $member]);
        $this->eventDispatcher->dispatch(new MemberFoundEvent($member));
        return $this->jsonReturn($member);
    }
}