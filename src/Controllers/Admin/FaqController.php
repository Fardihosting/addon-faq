<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */

namespace App\Addons\Faq\Controllers\Admin;

use App\Addons\Faq\Models\Faq;
use App\Addons\Faq\Models\Group;
use App\Http\Controllers\Admin\AbstractCrudController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends AbstractCrudController
{
    protected string $model = Faq::class;
    protected string $viewPath = 'faq::admin.';
    protected string $routePath = 'admin.faq';

    public function index(Request $request): View
    {
        $q        = $request->string('q');
        $groupId  = $request->integer('group_id');

        $faqs = Faq::query()
            ->with('group')
            ->when($q, fn ($qr) => $qr->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                  ->orWhere('reponse', 'like', "%{$q}%");
            }))
            ->when($groupId, fn ($qr) => $qr->where('group_id', $groupId))
            ->latest('id')
            ->paginate(15);

        // Pour le select des groupes [id => name]
        $groups = Group::query()->orderBy('name')->pluck('name', 'id')->toArray();

        return view($this->viewPath.'index', [
            'faqs'      => $faqs,
            'groups'    => $groups,
            'routePath' => $this->routePath,
        ]);
    }

    public function show(Faq $faq): View
    {
        // on charge le groupe pour éviter un N+1 si tu l'affiches
        $faq->load('group');

        // liste pour le select [id => name]
        $groups = Group::orderBy('name')->pluck('name', 'id')->toArray();

        // showView() affichera $this->viewPath.'show' avec les variables fournies
        return $this->showView([
            'faq'       => $faq,
            'groups'    => $groups,      // <- important
            'routePath' => $this->routePath,
        ]);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route($this->routePath.'.index')
            ->with('success', __('faq::messages.faq.delete'));
    }

    public function create(Request $request): View
    {
        return view($this->viewPath.'create', [
            'routePath' => $this->routePath,
            'groups'    => Group::orderBy('name')->pluck('name', 'id')->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => ['required','string','max:255'],
            'reponse'  => ['required','string'],
            'group_id' => ['nullable','integer','exists:groups,id'],
        ]);

        $faq = Faq::create($data);

        return redirect()->route($this->routePath.'.index')
            ->with('success', __('faq::messages.faq.create'));
    }

    public function edit(Faq $faq): View
    {
        return view($this->viewPath.'edit', [
            'faq'       => $faq,
            'routePath' => $this->routePath,
            'groups'    => Group::orderBy('name')->pluck('name', 'id')->toArray(),
        ]);
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'title'    => ['required','string','max:255'],
            'reponse'  => ['required','string'],
            'group_id' => ['nullable','integer','exists:groups,id'],
        ]);

        $faq->update($data);

        return redirect()->route($this->routePath.'.index')
            ->with('success', __('global.updated'));
    }
}
