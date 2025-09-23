<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */

namespace App\Addons\Faq\Controllers\Client;

use App\Addons\Faq\Models\Faq;
use App\Models\Store\Group;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FaqController extends Controller
{
    protected string $model = Faq::class;
    protected string $viewPath = 'faq::';
    protected string $routePath = 'client.faq';

    public function group(Group $group): View
    {
        $faqs = Faq::where('group_id', $group->id)
                    ->orderBy('id', 'desc')
                    ->get();

        return view('faq::index', [
            'group' => $group,
            'faqs'  => $faqs
        ]);
    }
}
