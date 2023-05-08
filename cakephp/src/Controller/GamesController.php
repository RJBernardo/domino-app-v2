<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable $Games
 *
 * @method \App\Model\Entity\Game[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GamesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'order' => ['id' => 'desc']
        ];
        $games = $this->paginate($this->Games);

        $this->set(compact('games'));
    }

    /**
     * View method
     *
     * @param string|null $id Game id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $game = $this->Games->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('game', $game);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $game = $this->Games->newEntity();
        if ($this->request->is('post')) {
            $game = $this->Games->patchEntity($game, $this->request->getData());
            $game->year = $game->data->i18nFormat('yyyy');
            $game->month = $game->data->i18nFormat('MM');
            $game->week = date("W", strtotime($game->data->i18nFormat('yyyy-MM-dd')));
            if ($this->Games->save($game)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso.', 'Game'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente.', 'Game'));
        }
        $users = $this->Games->Users->find('list')->where(['Users.active' => 'S']);
        $this->set(compact('game', 'users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addMany($user1 = null, $user2 = null, $user3 = null, $user4 = null)
    {
        $lastGame = $this->Games->find('all')->where(['game <>' => 0])->order(['id' => 'desc'])->first();
        if ($this->request->is('post')) {
            $maxGame = $lastGame->game + 1;

            $games = $this->Games->newEntities($this->request->getData('game'));
            $gamesToContinue = [];
            $ganhadores = "";
            foreach ($games as $game) {
                $game->data = Time::now();
                $game->game = $maxGame;
                $game->type_game = 'O';
                $game->qtd_games = 1;
                $game->qtd_win = 0;
                $game->year = $game->data->i18nFormat('yyyy');
                $game->month = $game->data->i18nFormat('MM');
                $game->week = date("W", strtotime($game->data->i18nFormat('yyyy-MM-dd')));
                if ($game->win == true) {
                    $game->qtd_win = 1;
                    $user = $this->Games->Users->find('all')->where(['Users.id' => $game->user_id])->first();
                    $ganhadores .= " " . $user->name;
                }
                if ($game->win == true || $this->request->getData('continua_todos') == 'true') {
                    $gamesToContinue[] = $game->user_id;
                } else {
                    $gamesToContinue[] = 0;
                }
            }
            if ($this->Games->saveMany($games)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso. A dupla ' . $ganhadores, 'Game'));
                if ($this->request->getData('continua') == 'true' || $this->request->getData('continua_todos') == 'true') {
                    return $this->redirect(['action' => 'addMany', $gamesToContinue[0], $gamesToContinue[1], $gamesToContinue[2], $gamesToContinue[3]]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente.', 'Game'));
            }
        } else {
            if ($user1 != null)
                $games[] = $this->Games->newEntity(['user_id' => $user1]);
            if ($user2 != null)
                $games[] = $this->Games->newEntity(['user_id' => $user2]);
            if ($user3 != null)
                $games[] = $this->Games->newEntity(['user_id' => $user3]);
            if ($user4 != null)
                $games[] = $this->Games->newEntity(['user_id' => $user4]);
        }
        //B => Bomba,\nL => Lasquina,\nS => Simples,\nBL => Bomba Lasquina,\nFN => Fechou natural,\nFF => Fechou Querendo / 'FNP' => 'Fechou Natural - Perdeu', 'M' => 'Merda'
        $type_win = ['' => 'Selecione', 'S' => 'Simples', 'L' => 'Lasquina', 'B' => 'Bomba', 'BL' => 'Bomba Lasquina', 'FNG' => 'Fechou Natural - Ganhou', 'FFG' => 'Fechou Querendo - Ganhou', 'FFP' => 'Fechou Querendo - Perdeu', 'M' => 'Merda'];
        $users = $this->Games->Users->find('list')->where(['Users.active' => 'S']);

        $sql = "SELECT
                    G.data,
                    G.user_id,
                    U.name,
                    Sum(G.qtd_games) as qtd_games,
                    Sum(G.qtd_win) as qtd_win,
                    (Sum(G.qtd_win) / Sum(G.qtd_games)) * 100 as Perc_Vit,
                    Sum(G.cheat) as qtd_merdas
                FROM `games` G
                Join `users` U On U.id = G.user_id
                WHERE G.data = DATE(NOW())
                GROUP By
                    G.data,
                    G.user_id,
                    U.name
                Order By
                    G.data,
                    Perc_Vit desc,
                    qtd_merdas,
                    qtd_win desc,
                    U.name";

        $connection = ConnectionManager::get('default');
        $results = $connection->execute($sql)->fetchAll('assoc');
        $this->set(compact('games', 'users', 'type_win', 'results'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Game id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $game = $this->Games->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $game = $this->Games->patchEntity($game, $this->request->getData());
            if ($this->Games->save($game)) {
                $this->Flash->success(__(' {0} foi salvo com sucesso.', 'Game'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__(' {0} não pôde ser salvo. Por favor, tente novamente', 'Game'));
        }
        $users = $this->Games->Users->find('list', ['limit' => 200]);
        $this->set(compact('game', 'users'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Game id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $game = $this->Games->get($id);
        if ($game->game == 0) {
            if ($this->Games->deleteAll(['id' => $game->id])) {
                $this->Flash->success(__(' {0} foi removido com sucesso.', 'Game'));
            } else {
                $this->Flash->error(__(' {0} não pôde ser deletado. Por favor, tente novamente.', 'Game'));
            }
        } else {
            if ($this->Games->deleteAll(['game' => $game->game])) {
                $this->Flash->success(__(' {0} foi removido com sucesso.', 'Game'));
            } else {
                $this->Flash->error(__(' {0} não pôde ser deletado. Por favor, tente novamente.', 'Game'));
            }
        }


        return $this->redirect(['action' => 'index']);
    }

    public function testeHora()
    {
        var_dump(Time::now()->i18nFormat('MM'));
        $date_string = "2019-12-28";
        $date_string2 = "2019-12-29";
        $date_string3 = "2019-12-30";
        $date_string4 = "2020-01-03";
        $date_string5 = "2020-01-04";
        $date_string6 = "2020-01-05";
        $date_string7 = "2020-01-06";
        echo "<br>";
        var_dump(date("W", strtotime($date_string)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string2)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string3)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string4)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string5)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string6)));
        echo "<br>";
        var_dump(date("W", strtotime($date_string7)));
        die;
    }

    public function xlsxSpout()
    {
        $query = $this->Games->find('all');
        $users = $this->Games->Users->find('all');
        $users->disableHydration();
        $query->disableHydration();
        $resultUsers = $users->toArray();

        // Converting the query to a key-value array will also execute it.
        $data = $query->toArray();
        $fileName = Time::now()->i18nFormat('YYYYMMDD_') . 'jogos_domino.xlsx';

        $writer = WriterEntityFactory::createXLSXWriter(); // for XLSX files
        $writer->openToBrowser($fileName); // stream data directly to the browser
        $headerRow = ['id', 'year', 'month', 'week', 'data', 'game', 'user_id', 'win', 'type_game', 'qtd_games', 'qtd_win', 'type_win_first', 'type_win_second', 'created', 'modified', 'created_by', 'cheat'];
        $rowFromValues = WriterEntityFactory::createRowFromArray($headerRow);
        $writer->addRow($rowFromValues);

        foreach ($data as $game) {
            $game['created'] = is_null($game['created']) ? '' : $game['created']->format('Y-m-d H:i:s');
            $game['modified'] = is_null($game['modified']) ? '' : $game['modified']->format('Y-m-d H:i:s');
            $game['data'] = is_null($game['data']) ? '' : $game['data']->format('Y-m-d H:i:s');
            foreach ($game as $key => $value) {
                if (is_null($value)) {
                    $game[$key] = "";
                }
            }
            // echo '<pre>' . var_export($game, true) . '</pre>';
            // die;
            try {
                $row = WriterEntityFactory::createRowFromArray((array) $game);
                $writer->addRow($row);
            } catch (Exception $e) {

            }
        }

        $writer->addNewSheetAndMakeItCurrent();
        $headerRowUser = ['id', 'name', 'email', 'photo_dir', 'photo', 'active', 'removed', 'created', 'modified', 'password', 'id_jogador', 'group_id', 'role_id'];
        $rowFromValuesUser = WriterEntityFactory::createRowFromArray($headerRowUser);
        $writer->addRow($rowFromValuesUser);

        foreach ($resultUsers as $user) {
            $user['created'] = is_null($user['created']) ? '' : $user['created']->format('Y-m-d H:i:s');
            $user['modified'] = is_null($user['modified']) ? '' : $user['modified']->format('Y-m-d H:i:s');
            foreach ($user as $key => $value) {
                if (is_null($value)) {
                    $user[$key] = "";
                }
            }
            // echo '<pre>' . var_export($game, true) . '</pre>';
            // die;
            try {
                $row = WriterEntityFactory::createRowFromArray((array) $user);
                $writer->addRow($row);
            } catch (Exception $e) {

            }
        }

        $writer->close();

        $this->RequestHandler->respondAs('xlsx');
        $this->autoRender = false;

    }

    /**
     * Dumps the MySQL database that this controller's model is attached to.
     * This action will serve the sql file as a download so that the user can save the backup to their local computer.
     *
     * @param string $tables Comma separated list of tables you want to download, or '*' if you want to download them all.
     */
    function adminDump($tables = '*')
    {

        $return = '';

        $modelName = 'Games';
        $dataSource = $this->{$modelName}->connection()->config();
        $databaseName = $dataSource['database'];


        // Do a short header
        $return .= '-- Database: `' . $databaseName . '`' . "\n";
        $return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";


        if ($tables == '*') {
            $tables = array();
            $result = $this->{$modelName}->query('SHOW TABLES');
            foreach ($result as $resultKey => $resultValue) {
                $tables[] = current($resultValue['TABLE_NAMES']);
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        // Run through all the tables
        foreach ($tables as $table) {
            $tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);

            $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
            $createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
            $createTableEntry = current(current($createTableResult));
            $return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";

            // Output the table data
            foreach ($tableData as $tableDataIndex => $tableDataDetails) {

                $return .= 'INSERT INTO ' . $table . ' VALUES(';

                foreach ($tableDataDetails[$table] as $dataKey => $dataValue) {

                    if (is_null($dataValue)) {
                        $escapedDataValue = 'NULL';
                    } else {
                        // Convert the encoding
                        $escapedDataValue = mb_convert_encoding($dataValue, "UTF-8", "ISO-8859-1");

                        // Escape any apostrophes using the datasource of the model.
                        $escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
                    }

                    $tableDataDetails[$table][$dataKey] = $escapedDataValue;
                }
                $return .= implode(',', $tableDataDetails[$table]);

                $return .= ");\n";
            }

            $return .= "\n\n\n";
        }

        // Set the default file name
        $fileName = $databaseName . '-backup-' . date('Y-m-d_H-i-s') . '.sql';

        // Serve the file as a download
        $this->autoRender = false;
        $this->response->type('Content-Type: text/x-sql');
        $this->response->download($fileName);
        $this->response->body($return);
    }
}