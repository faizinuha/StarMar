<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('owner')->latest()->get();
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create_group');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'privacy' => 'required|in:public,private',
        ]);

        try {
            // Buat grup baru
            $group = Group::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'description' => $request->description,
                'privacy' => $request->privacy,
            ]);

            // Tambahkan pengguna sebagai admin
            GroupMember::create([
                'group_id' => $group->id,
                'user_id' => auth()->id(),
                'role' => 'admin',
                'status' => 'approved',
            ]);

            return redirect()->route('groups.index')->with('success', 'Grup berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Group $group)
    {
        $group->load('members.user');
        return view('groups.show', compact('group'));
    }

    public function joinGroup(Group $group)
    {
        $status = $group->privacy == 'private' ? 'pending' : 'approved';

        GroupMember::firstOrCreate([
            'group_id' => $group->id,
            'user_id' => auth()->id(),
        ], [
            'role' => 'member',
            'status' => $status,
        ]);

        return redirect()->route('groups.show', $group->id)->with('success', 'Permintaan bergabung dikirim!');
    }

    public function approveMember(GroupMember $member)
    {
        $member->update(['status' => 'approved']);
        return back()->with('success', 'Anggota disetujui!');
    }

    public function leaveGroup(Group $group)
    {
        GroupMember::where('group_id', $group->id)->where('user_id', auth()->id())->delete();
        return redirect()->route('groups.index')->with('success', 'Anda telah keluar dari grup.');
    }

    public function removeMember(GroupMember $member)
    {
        $member->delete();
        return back()->with('success', 'Anggota berhasil dihapus.');
    }

    public function deleteGroup(Group $group)
    {
        if ($group->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus grup ini.');
        }

        $group->delete();
        return redirect()->route('groups.index')->with('success', 'Grup berhasil dihapus.');
    }

    public function promoteToAdmin(GroupMember $member)
    {
        $member->update(['role' => 'admin']);
        return back()->with('success', 'Anggota dipromosikan menjadi admin.');
    }
}
